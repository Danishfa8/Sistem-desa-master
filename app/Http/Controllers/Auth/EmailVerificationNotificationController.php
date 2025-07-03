<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\FonnteService;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    protected $fonnte;

    public function __construct(FonnteService $fonnte)
    {
        $this->fonnte = $fonnte;
    }

    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Kirim email verifikasi default Laravel
        $user->sendEmailVerificationNotification();

        // Buat signed URL manual (untuk dikirim WA)
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $user->getKey(), 'hash' => sha1($user->email)]
        );

        // Pendekkan URL verifikasi menggunakan s.id
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.s.id/v1/links', [
                'headers' => [
                    'X-Auth-Id' => env('SID_AUTH_ID'),
                    'X-Auth-Key' => env('SID_AUTH_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'long_url' => $verificationUrl,
                ],
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            if (isset($body['data']['short'])) {
                $shortUrl = "https://s.id/" . $body['data']['short'];
            } else {
                Log::error('Gagal mempersingkat URL s.id', ['response' => $body]);
                $shortUrl = $verificationUrl; // fallback: pakai URL asli
            }
        } catch (\Exception $e) {
            Log::error('Error shorten URL s.id', ['error' => $e->getMessage()]);
            $shortUrl = $verificationUrl; // fallback
        }

        // Kirim pesan WhatsApp dengan FonnteService
        try {
            if (empty($user->telephone)) {
                Log::warning('User tidak memiliki nomor telepon untuk WA', ['user_id' => $user->id]);
            } else {
                $message = "Halo {$user->name},\n\nSilakan verifikasi email Anda melalui tautan berikut:\n$shortUrl\n\nBest Regards:\nStarterkit SangkalaTech";

                $deviceToken = env('DEVICE_TOKEN');

                $waResponse = $this->fonnte->sendWhatsAppMessage($user->telephone, $message, $deviceToken);

                Log::info('Fonnte WA Response', ['response' => $waResponse]);
            }
        } catch (\Exception $e) {
            Log::error('Gagal mengirim WA verifikasi email', ['error' => $e->getMessage()]);
        }

        return back()->with('status', 'verification-link-sent');
    }
}

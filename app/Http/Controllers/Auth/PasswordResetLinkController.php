<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FonnteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !$user->telephone) {
            return back()->withErrors(['email' => 'Email tidak ditemukan atau belum memiliki nomor WhatsApp.']);
        }

        // Buat token reset password
        $token = Password::createToken($user);

        // Buat URL reset password asli
        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        // Short URL by s.id
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://api.s.id/v1/links', [
            'headers' => [
                'X-Auth-Id' => env('SID_AUTH_ID'),
                'X-Auth-Key' => env('SID_AUTH_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'long_url' => $resetUrl,
            ],
        ]);

        $body = json_decode($response->getBody()->getContents(), true);

        if (isset($body['data']['short'])) {
            $shortUrl = "https://s.id/" . $body['data']['short'];
        } else {
            Log::error('Gagal mempersingkat URL s.id', ['response' => $body]);
            return back()->withErrors(['email' => 'Gagal mempersingkat URL. Silakan coba lagi.']);
        }

        // Kirim melalui WhatsApp
        $message = "Halo {$user->name},\n\nBerikut link untuk reset password akun Anda:\n\n$shortUrl\n\nAbaikan jika Anda tidak meminta reset.\nBest Regards,\nStarterkit SangkalaTech";

        $fonnte = new FonnteService();
        $waResponse = $fonnte->sendWhatsAppMessage($user->telephone, $message, env('DEVICE_TOKEN'));
        Log::info('Fonnte WA Response', ['response' => $waResponse]);

        if ($waResponse['status']) {
            return back()->with('status', 'Tautan reset password telah dikirim ke WhatsApp Anda.');
        } else {
            return back()->withErrors(['email' => 'Gagal mengirim pesan WhatsApp: ' . $waResponse['error']]);
        }
    }
}

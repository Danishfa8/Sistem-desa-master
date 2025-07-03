<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\Settingwebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingwebsiteController extends Controller
{
    public function index()
    {
        $setting = Settingwebsite::first() ?? new Settingwebsite();
        return view('superadmin.settingwebsite.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg,gif|max:2048',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        $setting = Settingwebsite::first();
        if (!$setting) {
            $setting = new Settingwebsite();
        }

        $setting->title = $request->title;
        $setting->description = $request->description;

        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $faviconPath = $request->file('favicon')->store('settings', 'public');
            $setting->favicon = $faviconPath;
        }

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }

            $logoPath = $request->file('logo')->store('settings', 'public');
            $setting->logo = $logoPath;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui');
    }
}

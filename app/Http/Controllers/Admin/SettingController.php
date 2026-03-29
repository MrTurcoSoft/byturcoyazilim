<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->settings as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Ayarlar kaydedildi.');
    }

    public function theme()
    {
        return view('admin.settings.theme');
    }

    public function updateTheme(Request $request)
    {
        Setting::set('theme_mode', $request->theme_mode, 'select', 'appearance');
        Setting::set('primary_color', $request->primary_color, 'color', 'appearance');

        return back()->with('success', 'Tema ayarları kaydedildi.');
    }
}

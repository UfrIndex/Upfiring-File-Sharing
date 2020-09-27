<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id != 3) {
            abort(404);
        }
        $header_script =  Setting::where('name', 'header_script')->first();
        $footer_script =  Setting::where('name', 'footer_script')->first();
        $footer =  Setting::where('name', 'footer')->first();

        return view('admin.setting.index', [
            'header_script' => $header_script->code,
            'footer_script' => $footer_script->code,
            'footer' => $footer->code
        ]);
    }

    public function update(Request $request, Setting $setting)
    {
        if(Auth::user()->role_id != 3) {
            abort(404);
        }

        Setting::where('name', 'header_script')->update(['code' => $request->headerScript]);
        Setting::where('name', 'footer_script')->update(['code' => $request->footerScript]);
        Setting::where('name', 'footer')->update(['code' => $request->footer]);

        return redirect()->route('admin.setting.index');
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Http\Controllers\Controller;
use App\Rules\Captcha;
use App\Setting;
use App\UfrFile;
use Illuminate\Http\Request;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;


class SendmailController extends Controller
{
    private $header_script = '';
    private $footer_script = '';
    private $footer = '';

    public function __construct()
    {
        $this->header_script =  Setting::where('name', 'header_script')->first()->code;
        $this->footer_script =  Setting::where('name', 'footer_script')->first()->code;
        $this->footer =  Setting::where('name', 'footer')->first()->code;
    }

    public function contact()
    {
        return view('mail.contact', [
            'title' => 'Contact us',
            'mail' => 'mail!!!!!!!!!!!!!',
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }

    public function dmca(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => new Captcha()
        ]);

        return view('mail.contact', [
            'title' => 'DMCA',
            'mail' => 'mail!!!!!!!!!!!!!',
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }

    public function send_contact_form(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => new Captcha()
        ]);
        return redirect()->action('Site\SendmailController@thank_you');
    }

    public function thank_you()
    {
        return view('mail.sent', [
            'title' => 'Thanks you',
            'mail' => 'Your message has been sent.',
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }


    public function test()
    {
        \App\Jobs\SendEmail::dispatch("Test msg");
    }

    public function index()
    {
        try {
            Mail::send(new Contact());
        }
        catch (\Exception $e) {
            return $e;
        }
        return ('send');
    }
}

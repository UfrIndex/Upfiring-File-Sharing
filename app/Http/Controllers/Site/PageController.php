<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Http\Controllers\Controller;
use App\Page;
use App\Setting;
use App\UfrFile;


class PageController extends Controller
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

    public function index($slug) {
        return view('site.page',[
            'page' => Page::where('slug', $slug)->where('published', true)->firstOrFail(),
            'categories' => Category::get(),
            'count_ufr_files' => UfrFile::where('visible', '1')->count(),
            'header_script' => $this->header_script,
            'footer_script' => $this->footer_script,
            'footer' =>  $this->footer,
        ]);
    }
}

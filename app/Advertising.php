<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'banner_left',
        'banner_right',
        'banner_top',
        'content_top',
        'enable_content_top',
        'show_homepage_content_top',
        'enable_banner_top',
        'show_homepage_banner_top',
        'enable_banner_banner_left_and_right',
        'show_homepage_banner_left_and_right'
    ];
}

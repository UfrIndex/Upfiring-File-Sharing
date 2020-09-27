<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable = [
        'title', 'text', 'slug', 'published', 'short_description', 'image', 'image_show', 'meta_title', 'meta_description'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = htmlentities($value);
    }

    public function getTitleAttribute($value)
    {
        return $this->attributes['title'] = html_entity_decode($value);
    }


}

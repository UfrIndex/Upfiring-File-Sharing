<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UfrFile extends Model
{
    protected $fillable = [
        'visible'
    ];

    private function get_unique_slug($slug, $id = 0) {
        $file_slug = ($id == 0) ? UfrFile::where('slug', $slug)->first() : UfrFile::where('slug', $slug . '-' . $id)->first();
        if ($file_slug) {
            return  ($this->get_unique_slug($slug, ++$id));
        }
        else {
            $return_slug = ($id == 0) ? $slug : $slug. '-' . $id;
            return $return_slug;
        }
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function report()
    {
        return $this->hasMany('App\Report');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function setSlugAttribute($value)
    {

        $this->attributes['slug'] = $this->get_unique_slug($value);
    }

    public function getSizeAttribute($value)
    {
        return ($value < 1024) ? $value .' MB' : round( $value/1000, 2 ) .' GB';
    }

}

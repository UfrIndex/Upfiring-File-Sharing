<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'ufr_file_id',
        'type',
        'text',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function ufrfile()
    {
        return $this->belongsTo('App\UfrFile', 'ufr_file_id');
    }
}

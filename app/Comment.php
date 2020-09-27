<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function ufrfile()
    {
        return $this->belongsTo('App\UfrFile', 'ufr_file_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}

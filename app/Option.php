<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'description',
        'title',
        'template',
        'frontpage_status',
        'homepage_first_position',
        'homepage_first_status',
        'homepage_second_position',
        'homepage_second_status',
        'homepage_third_position',
        'homepage_third_status',
        'homepage_fourth_position',
        'homepage_fourth_status',
        'count_row_in_first_position',
        'count_row_in_second_position',
        'count_row_in_third_position',
        'count_row_in_fourth_position',
        'enable_alternative_table_in_home',
        'count_rows_in_alternative_table',
        'moderation_status'
    ];
}

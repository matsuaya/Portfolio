<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'day' => 'required',
        'employee_code' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'break_time' => 'required',
    );
}

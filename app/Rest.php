<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'day' => 'required',
        'employee_code' => 'required',
        'name' => 'required',
        'plan_rest_time' => 'required',
    );
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'employee_code' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'break_time' => 'required',
    );
    
    protected $dates = ['start_time','end_time'];
    
    public function fill_history($request){
        $this->employee_code=$request->employee_code;
        $this->start_time=date( 'Y-m-d H:i:s', strtotime( $request->start_time ));
        $this->end_time=date( 'Y-m-d H:i:s', strtotime( $request->end_time ));
        $this->break_time=$request->break_time;
        
        return $this;
    }
}

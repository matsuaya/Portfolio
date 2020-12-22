<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Carbon\Carbon;
use App\History;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_code','name', 'email', 'password','role','sum_rest_time',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected $guarded = array('id');

    public static $rules = array(
        'employee_code' => 'required',
        'name' => 'required',
        'password' => 'required',
        'role' => 'required',
        'sum_rest_time' => 'required',
    );
    
    public  static function getCurrentHistories(){
        $today=new Carbon();
        $today=Carbon::now()->format('m');
        $employee_code=Auth::user()->employee_code;
        $histories=History::whereMonth('start_time',$today )
                    ->where('employee_code',$employee_code)
                    ->orderBy('start_time','asc')->get();
                    
        return $histories;
    }
}

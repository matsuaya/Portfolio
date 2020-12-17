<?php

namespace App\Providers;
use Validator;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'not_same_day',
            function ($attribute, $value, $parameters, $validator) {
                $formated_date = Carbon::parse($value)->format('Y-m-d');
                $same_day_histories = History::whereDate('start_time',$formated_date)->get();
                $result;
                if(count($same_day_histories) == 0){
                  $result = true;
                }else{
                  $result = false;
                }
                return $result;
            }
        );
    }
}

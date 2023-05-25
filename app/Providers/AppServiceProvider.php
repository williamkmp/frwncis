<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('time_greater_than', function ($attribute, $value, $parameters, $validator) {
            $openingHour = $validator->getData()[$parameters[0]];
            return strtotime($value) > strtotime($openingHour);
        });

        Validator::replacer('time_greater_than', function ($message, $attribute, $rule, $parameters) {
            $start = str_replace("_" , " ", $parameters[0]);
            $end = str_replace("_" , " ",$attribute);
            return "the " . $start . " must be greater than the ". $end;
        });
    }
}

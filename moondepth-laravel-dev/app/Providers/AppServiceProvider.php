<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
        // Minimize StringLength for old version of MySQL
        Schema::defaultStringLength(191);

        // Custom validator for 'username' in registration form
        Validator::extend('alphanum', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\S*$/u', $value);
        });
        Validator::replacer('alphanum', function ($message, $attribute, $rule, $parameters) {
            return "Only alphanumeric symbols";
        });
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


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
        Schema::defaultStringLength(191);
        $system_configs = DB::table('System')->where('isActive',1)->get();
        if($system_configs && count($system_configs) > 0){
            $configSystemOrderet = new \stdClass();
            foreach ($system_configs as $configSystem){
                $key = $configSystem->key_type;
                $configSystemOrderet->$key = $configSystem->value;

            }
            config(['system.configs' => $configSystemOrderet]);


        }
    }
}

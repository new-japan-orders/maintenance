<?php

namespace NewJapanOrders\Maintenance;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider {

    /** 
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {   
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }   

    /** 
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {   
        
    }   
}

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
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'maintenance');
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

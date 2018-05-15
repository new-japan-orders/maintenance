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
        $view_dir = resource_path('/views/maintenances');
        if (!file_exists($view_dir)) {
            mkdir($view_dir);
        }
        $this->publishes([
            __DIR__.'/resources/views/index.blade.php' => $view_dir.'/index.blade.php',
            __DIR__.'/resources/views/create.blade.php' => $view_dir.'/create.blade.php',
            __DIR__.'/resources/views/edit.blade.php' => $view_dir.'/edit.blade.php',
        ]);
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

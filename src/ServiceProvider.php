<?php
namespace Hieu\ProductManagement;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/../public/uploads' => public_path('uploads'),
            __DIR__.'/config/filesystems.php' => config_path('filesystems.php')
        ], 'public');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }
}

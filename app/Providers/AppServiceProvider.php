<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Alias App\Core\Database to global Database for old models
        if (!class_exists('Database')) {
            class_alias('App\Core\Database', 'Database');
        }

        // Fix for "Undefined variable $data" in old view templates
        View::composer('*', function ($view) {
            $data = $view->getData();
            
            // Set default db_status to prevent warnings in header.php if not set
            if (!array_key_exists('db_status', $data)) {
                $data['db_status'] = true; // Assume true or implement custom check if Database class exists
            }
            
            $view->with('data', $data);
        });
    }
}

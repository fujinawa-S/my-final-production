<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            config(['cloudinary.verify_ssl' => false]);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Allow multi-image uploads locally.
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '25M');
        ini_set('max_file_uploads', '10');
    }
}

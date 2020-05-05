<?php

namespace App\Providers;

use App\Services\AvatarStorageService;
use App\Services\Interfaces\AvatarServiceInterface;
use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AvatarServiceInterface::class, AvatarStorageService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

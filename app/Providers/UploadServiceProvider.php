<?php

namespace App\Providers;

use App\Services\Storage\AvatarService;
use App\Services\Storage\Interfaces\AvatarServiceInterface;
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
        $this->app->singleton(AvatarServiceInterface::class, AvatarService::class);
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

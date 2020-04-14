<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Publication' => 'App\Policies\PublicationPolicy',
        'App\Internship' => 'App\Policies\InternshipPolicy',
        'App\Qualification' => 'App\Policies\QualificationPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('moderate', function(User $user){
           return $user->role <= User::ROLE_MODERATOR;
        });
    }
}

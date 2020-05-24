<?php

namespace App\Providers;

use App\Internship;
use App\Policies\InternshipPolicy;
use App\Policies\PublicationPolicy;
use App\Policies\QualificationPolicy;
use App\Policies\RebukePolicy;
use App\Publication;

use App\Qualification;
use App\Rebuke;
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
        Publication::class => PublicationPolicy::class,
        Internship::class => InternshipPolicy::class,
        Qualification::class => QualificationPolicy::class,
        Rebuke::class, RebukePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function(User $user){
            return $user->role == User::ROLE_ADMIN;
        });

        Gate::define('moderate', function(User $user){
           return $user->role <= User::ROLE_MODERATOR;
        });

        Gate::define('view', function(User $user){
            return $user->role <= User::ROLE_VIEWER;
        });
    }
}

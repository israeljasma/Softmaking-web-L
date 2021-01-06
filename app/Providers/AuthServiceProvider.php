<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Generic
        Gate::define('generic-administration', function($user){
            return $user->hasAnyRoles(['Admin', 'SuperAdmin']);
        });

        // Only Super Admin
        Gate::define('manage-superadmin', function($user){
            return $user->hasRole(['SuperAdmin']);
        });

        // Users
        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['Admin', 'SuperAdmin']);
        });

        Gate::define('edit-users', function($user){
            return $user->hasAnyRoles(['Admin', 'SuperAdmin']);
        });

        Gate::define('delete-users', function($user){
            return $user->hasRole('SuperAdmin');
        });

        // Invoices
        Gate::define('manage-invoices', function($user){
            return $user->hasAnyRoles(['Admin', 'SuperAdmin']);
        });

        Gate::define('edit-invoices', function($user){
            return $user->hasAnyRoles(['Admin', 'SuperAdmin']);
        });

        Gate::define('delete-invoices', function($user){
            return $user->hasRole('SuperAdmin');
        });
    }
}

<?php

namespace App\Providers;


use App\Models\Admin;
/*use App\Policies\AdminPolicy;*/
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        /*Admin::class => AdminPolicy::class,*/
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}

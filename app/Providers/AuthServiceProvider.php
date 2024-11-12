<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('product_access', function ($user) {
            return $user->hasPermission('product_access'); // ganti dengan logika izin yang sesuai
        });

        Gate::define('product_create', function ($user) {
            return $user->hasPermission('product_create');
        });

        Gate::define('product_view', function ($user) {
            return $user->hasPermission('product_view');
        });

        Gate::define('product_edit', function ($user) {
            return $user->hasPermission('product_edit');
        });

        Gate::define('product_delete', function ($user) {
            return $user->hasPermission('product_delete');
        });
    }
}

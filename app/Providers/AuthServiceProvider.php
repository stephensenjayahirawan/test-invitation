<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Product;
use App\Policies\ProductPolicy;
use App\Policies\InvitationPolicy;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        Product::class => ProductPolicy::class,
        User::class => InvitationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('restore-product', [ProductPolicy::class, 'restore']);
        Gate::define('update-product', [ProductPolicy::class, 'update']);
        Gate::define('view-product', [ProductPolicy::class, 'view']);
        Gate::define('create-product', [ProductPolicy::class, 'create']);
        Gate::define('delete-product', [ProductPolicy::class, 'delete']);
        Gate::define('create-invite', [InvitationPolicy::class, 'create']);
        Gate::define('view-invite', [InvitationPolicy::class, 'viewAny']);
        //
    }
}

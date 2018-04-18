<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();
    }

    public function registerPostPolicies()
    {
        Gate::define('create-post', 'App\Policies\PostPolicy@create');
        Gate::define('update-post', 'App\Policies\PostPolicy@update');
        Gate::define('publish-post', 'App\Policies\PostPolicy@publish');
        Gate::define('delete-post', 'App\Policies\PostPolicy@delete');
        Gate::define('see-all-drafts', 'App\Policies\PostPolicy@drafts');
    }
}

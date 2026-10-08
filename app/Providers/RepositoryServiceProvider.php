<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Lead\LeadRepositoryInterface::class, \App\Repositories\Lead\LeadRepository::class);

        $this->app->bind(\App\Repositories\Account\AccountRepositoryInterface::class,\App\Repositories\Account\AccountRepository::class);

        $this->app->bind(\App\Repositories\Contacts\ContactRepositoryInterface::class,\App\Repositories\Contacts\ContactRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

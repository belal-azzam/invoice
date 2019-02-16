<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Repositories\InvoiceRepositoryInterface',
            'App\Repositories\InvoiceRepository'
        );
        $this->app->bind(
            'App\Repositories\InvoiceItemRepositoryInterface',
            'App\Repositories\InvoiceItemRepository'
        );
    }
}

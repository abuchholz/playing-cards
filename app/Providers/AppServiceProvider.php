<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CardService;

class AppServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CardService::class, function(){
            return new CardService(cache()->store('redis'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [CardService::class];
    }
}

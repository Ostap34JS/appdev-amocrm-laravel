<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Cookie\FileCookieJar;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('guzzle', function () {
            return new Client([
                'base_uri' => 'https://'.config('services.amocrm.subdomain').'.amocrm.com/',
                'cookies' => new FileCookieJar(storage_path('cookies')),
                'headers' => [
                    'User-Agent' => 'amoCRM-API-client/1.0'
                ]
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace Payone\Laravel;

use Payone\PayoneClient;

class PayoneServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__ . '/../config/payone.php') => config_path('payone.php'),
        ]);

        $this->mergeConfigFrom(
            realpath(__DIR__ . '/../config/payone.php'), 'payone'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('payone', function ($app) {

            $client = new PayoneClient();

            $client->setApiEndpoint($app['config']['api_endpoint'])
                ->setApiVersion($app['config']['api_version'])
                ->setEncoding($app['config']['encoding'])
                ->setMid($app['config']['mid'])
                ->setAid($app['config']['aid'])
                ->setPortalId($app['config']['portalId'])
                ->setKey($app['config']['key'])
                ->setMode($app['config']['mode']);

            return $client;
        });
    }
}
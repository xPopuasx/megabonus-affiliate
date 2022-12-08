<?php

namespace Megabonus\Laravel\Affiliate\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Megabonus\Laravel\Affiliate\Affiliate;
use Megabonus\Laravel\Affiliate\Clients\TaoBaoClient;
use Megabonus\Laravel\Affiliate\Services\Check\CheckService;
use Megabonus\Laravel\Affiliate\Services\Client\ClientParserService;

class AffiliateServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->publishes([
            $this->getConfigFile() => config_path('affiliate.php')
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            $this->getConfigFile(),
            'affiliate'
        );

        $this->app->bind('affiliate', function ($app) {
            return new Affiliate(
                $app->make(CheckService::class),
                $app->make(TaoBaoClient::class),
                $app->make(ClientParserService::class)
            );
        });
    }

    /**
     * @return string
     */
    protected function getConfigFile(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'affiliate.php';
    }
}

<?php

namespace Megabonus\Laravel\Affiliate\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Megabonus\Laravel\Affiliate\Affiliate as FakeAffiliate;
use Megabonus\Laravel\Affiliate\Facades\Affiliate;

class AffiliateServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->publishes([
            $this->getConfigFile() => config_path('affiliate.php')
        ], 'config');

        $this->registerFacades();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            $this->getConfigFile(),
            'affiliate'
        );

        $this->app->bind(FakeAffiliate::class);
    }

    protected function registerFacades(){
        $this->app->singleton('Affiliate', function($app){
            return new Affiliate();
        });
    }

    /**
     * @return string
     */
    protected function getConfigFile(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'affiliate.php';
    }
}

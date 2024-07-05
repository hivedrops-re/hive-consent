<?php

namespace Hivedrops\HiveConsent;

use Hivedrops\HiveConsent\Console\Commands\PublishConfig;
use Illuminate\Support\ServiceProvider;
use Hivedrops\HiveConsent\Console\Commands\PublishViews;

class HiveConsentServiceProvider extends ServiceProvider 
{
    /**
     * Bootstrap any package service
     * 
     * @return void
     */
    public function boot() 
    {
        // Charger les vues du package
        $this->loadViewsFrom(__DIR__.'/resources/views', 'hive-consent-banner');

        // Publie les vues pour la personnalisation
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/hive-consent'), 
        ], 'hive-consent');

        $this->publishes([
            __DIR__.'/config/hive-consent.php' => config_path('hive-consent.php'),
        ], 'config');

        if($this->app->runningInConsole()) {
            $this->commands([
                PublishViews::class,
                PublishConfig::class
            ]);
        }
    }

    /**
     * Register any package service
     * 
     * @return void
     */
    public function register() 
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/hive-consent.php', 'hive-consent'
        );
    }
}
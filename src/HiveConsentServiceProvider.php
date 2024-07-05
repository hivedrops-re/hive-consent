<?php

namespace Hivedrops\HiveConsent;

use Hivedrops\HiveConsent\Console\Commands\PublishConfig;
use Hivedrops\HiveConsent\Console\Commands\PublishLang;
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
        // Load package views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'hive-consent-banner');
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'hive-consent');

        // Publish package views and files for customization
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/hive-consent'), 
        ], 'hive-consent');

        $this->publishes([
            __DIR__.'/config/hive-consent.php' => config_path('hive-consent.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/hive-consent'),
        ], 'lang');

        if($this->app->runningInConsole()) {
            $this->commands([
                PublishViews::class,
                PublishConfig::class,
                PublishLang::class,
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
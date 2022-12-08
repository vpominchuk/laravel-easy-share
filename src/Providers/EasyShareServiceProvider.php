<?php


namespace VPominchuk\EasyShare\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use VPominchuk\EasyShare\EasyShare;
use VPominchuk\EasyShare\EasyShareComponent;

class EasyShareServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/easy-share.php' => config_path('easy-share.php')
        ], 'easy-share-config');

        $this->registerComponent();

        $this->loadViewsFrom(__DIR__.'/../views', 'easy-share');
    }

    protected function registerComponent(): void
    {
        Blade::component('easy-share', EasyShareComponent::class);
    }
}

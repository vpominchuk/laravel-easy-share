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

        if (class_exists('\\Illuminate\\Foundation\\Console\\AboutCommand')) {
            $this->aboutCommand();
        }

        $this->registerComponent();

        $this->loadViewsFrom(__DIR__.'/../views', 'easy-share');
    }

    protected function registerComponent(): void
    {
        Blade::component('easy-share', EasyShareComponent::class);
    }

    protected function aboutCommand(): void
    {
        $links = \VPominchuk\EasyShare\Facades\EasyShare::getAllServices();

        \Illuminate\Foundation\Console\AboutCommand::add(
            'Laravel Easy Share',
            [
                'Config' => fn () => file_exists(config_path('easy-share.php')) ? 'OK' : 'Failed'
            ]
        );

        \Illuminate\Foundation\Console\AboutCommand::add(
            'Laravel Easy Share',
            [
                'Services' => fn () => ''
            ]
        );

        if (!empty($links)) {
            foreach ($links as $service => $link) {
                $serviceName = mb_chr(0x2022, 'UTF-8') . ' ' . $service;
                $commandResponse[$serviceName] = 'OFF';

                if ($link['allowed']) {
                    $commandResponse[$serviceName] = 'ON';
                }
            }
        }

        \Illuminate\Foundation\Console\AboutCommand::add('Laravel Easy Share', fn () => $commandResponse);
    }
}

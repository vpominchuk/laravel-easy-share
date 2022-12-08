<?php


namespace VPominchuk\EasyShare\Facades;


use VPominchuk\EasyShare\EasyShareService;

/**
 * Class EasyShare
 * @package VPominchuk\EasyShare\Facades
 *
 * @method static \VPominchuk\EasyShare\EasyShareService setUrl(string $url)
 * @method static Illuminate\Support\Collection getAllowedServices()
 * @method static array getAllServices()
 */
class EasyShare extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return EasyShareService::class;
    }
}

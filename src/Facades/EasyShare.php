<?php


namespace VPominchuk\EasyShare\Facades;


/**
 * Class EasyShare
 * @package VPominchuk\EasyShare\Facades
 *
 * @method static \VPominchuk\EasyShare\EasyShare setUrl(string $url)
 * @method static Illuminate\Support\Collection getAllowedServices()
 * @method static array getAllServices()
 */
class EasyShare extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'easy.share';
    }
}

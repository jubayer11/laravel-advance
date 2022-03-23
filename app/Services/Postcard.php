<?php

namespace App\Services;

class Postcard
{


    protected static function resolveFacade($name)
    {
        return app()[$name];
    }

    public static function __callStatic($name, $arguments)
    {
        return (self::resolveFacade('Postcard'))->$name(...$arguments);
    }


}

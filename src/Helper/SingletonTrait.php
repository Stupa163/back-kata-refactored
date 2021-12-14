<?php

namespace App\src\Helper;

trait SingletonTrait
{
    protected static ?self $instance = null;

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}

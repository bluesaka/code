<?php

namespace singleton;

class Singleton
{
    private static $instance = null;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {
        if (is_null(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    public function test()
    {
        echo "hello world";
    }
}
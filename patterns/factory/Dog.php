<?php

namespace factory;

class Dog implements AnimalInterface
{

    public function __construct()
    {
        echo "创建了一只狗" .PHP_EOL;
    }
}
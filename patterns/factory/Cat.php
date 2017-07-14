<?php

namespace factory;

class Cat implements AnimalInterface
{

    public function __construct()
    {
        echo "创建了一只猫" .PHP_EOL;
    }
}
<?php

namespace flyweight;

class Dog implements AnimalInterface
{

    public function getName()
    {
        echo "我是一只狗" . PHP_EOL;
    }
}
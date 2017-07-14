<?php

namespace flyweight;

class Pig implements AnimalInterface
{

    public function getName()
    {
        echo "我是一只猪" . PHP_EOL;
    }
}
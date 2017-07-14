<?php

namespace facade;

class Dog implements AnimalInterface
{
    public function create()
    {
        echo "生成一只狗" . PHP_EOL;
    }

}
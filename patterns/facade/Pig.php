<?php

namespace facade;

class Pig implements AnimalInterface
{
    public function create()
    {
        echo "生成一只猪" . PHP_EOL;
    }

}
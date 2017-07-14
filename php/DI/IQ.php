<?php

namespace DI;

class IQ implements PersonInterface
{
    public function create()
    {
        echo "生成智商..." . PHP_EOL;
    }

}
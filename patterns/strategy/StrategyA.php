<?php

namespace strategy;

class StrategyA implements StrategyInterface
{
    public function hello()
    {
        echo "策略A" . PHP_EOL;
    }

}
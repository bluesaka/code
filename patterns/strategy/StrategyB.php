<?php

namespace strategy;

class StrategyB implements StrategyInterface
{
    public function hello()
    {
        echo "策略B" . PHP_EOL;
    }

}
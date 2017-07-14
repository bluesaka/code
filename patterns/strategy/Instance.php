<?php

namespace strategy;

class Instance
{
    private $strategy;

    public function __construct(StrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function doSomething()
    {
        $this->strategy->hello();
    }
}
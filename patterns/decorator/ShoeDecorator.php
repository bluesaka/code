<?php

namespace decorator;

abstract class ShoeDecorator implements ShoeInterface
{
    protected $shoe;

    public function __construct(ShoeInterface $shoe)
    {
        $this->shoe = $shoe;
    }

    public function produce()
    {
        $this->shoe->produce();
    }

    abstract function decorate();
}
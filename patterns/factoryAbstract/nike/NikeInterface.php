<?php

namespace factoryAbstract\nike;

use factoryAbstract\SaleInterface;

interface NikeInterface extends SaleInterface
{
    public function produce();
}
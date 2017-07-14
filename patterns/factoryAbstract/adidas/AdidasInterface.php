<?php

namespace factoryAbstract\adidas;

use factoryAbstract\SaleInterface;

interface AdidasInterface extends SaleInterface
{
    public function produce();
}
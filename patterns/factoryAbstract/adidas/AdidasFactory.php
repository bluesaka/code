<?php

namespace factoryAbstract\adidas;

use factoryAbstract\Factory;

class AdidasFactory implements Factory
{
    public function createShoe()
    {
        return new AdidasShoe();
    }

    public function createClothes()
    {
        return new AdidasClothes();
    }

}
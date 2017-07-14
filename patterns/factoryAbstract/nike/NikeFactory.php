<?php

namespace factoryAbstract\nike;

use factoryAbstract\Factory;

class NikeFactory implements Factory
{
    public function createShoe()
    {
        return new NikeShoe();
    }

    public function createClothes()
    {
        return new NikeClothes();
    }

}
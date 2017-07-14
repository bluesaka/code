<?php

namespace factoryAbstract\nike;

class NikeClothes implements NikeInterface
{

    public function produce()
    {
        echo "生产Nike衣服" . PHP_EOL;
    }

    public function sale()
    {
        echo "销售Nike衣服" . PHP_EOL;
    }
}
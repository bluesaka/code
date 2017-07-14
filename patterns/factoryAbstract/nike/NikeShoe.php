<?php

namespace factoryAbstract\nike;

class NikeShoe implements NikeInterface
{

    public function produce()
    {
        echo "生产Nike鞋子" . PHP_EOL;
    }

    public function sale()
    {
        echo "销售Nike鞋子" . PHP_EOL;
    }
}
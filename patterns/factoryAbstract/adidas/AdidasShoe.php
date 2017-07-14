<?php

namespace factoryAbstract\adidas;

class AdidasShoe implements AdidasInterface
{

    public function produce()
    {
        echo "生产Adidas鞋子" . PHP_EOL;
    }

    public function sale()
    {
        echo "销售Adidas鞋子" . PHP_EOL;
    }
}
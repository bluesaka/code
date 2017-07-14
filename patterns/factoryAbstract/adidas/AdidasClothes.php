<?php

namespace factoryAbstract\adidas;

class AdidasClothes implements AdidasInterface
{

    public function produce()
    {
        echo "生产Adidas衣服" . PHP_EOL;
    }

    public function sale()
    {
        echo "销售Adidas衣服" . PHP_EOL;
    }
}
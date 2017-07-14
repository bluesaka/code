<?php

namespace decorator;

class ShoeDecoratorPrice extends ShoeDecorator
{
    private $price;

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function produce()
    {
        $this->shoe->produce();
        $this->decorate();
    }

    function decorate()
    {
        echo "贴上价格：" . $this->price . PHP_EOL;
    }

}
<?php

namespace decorator;

class ShoeDecoratorSize extends ShoeDecorator
{
    private $size;

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function produce()
    {
        $this->shoe->produce();
        $this->decorate();
    }

    function decorate()
    {
        echo "贴上尺码：" . $this->size . PHP_EOL;
    }

}
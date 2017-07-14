<?php

namespace decorator;

class ShoeAdidas implements ShoeInterface
{
    public function produce()
    {
        echo "生产Adidas鞋子" . PHP_EOL;
    }

}
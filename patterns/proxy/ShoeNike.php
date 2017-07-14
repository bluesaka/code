<?php

namespace proxy;

class ShoeNike implements ShoeInterface
{
    public function produce()
    {
        echo "生产Nike鞋子" . PHP_EOL;
    }

}
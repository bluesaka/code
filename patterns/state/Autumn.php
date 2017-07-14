<?php

namespace state;

class Autumn implements SeasonInterface
{
    private $season = '秋天';

    public function come()
    {
        echo $this->season . "来了！！！" . PHP_EOL;
    }

    public function go()
    {
        echo $this->season . "走了~~~" . PHP_EOL;
    }

}
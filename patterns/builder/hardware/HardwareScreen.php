<?php

namespace builder\hardware;

class HardwareScreen implements Hardware
{

    public function produce($size = '')
    {
        echo "硬件 - 屏幕大小：$size" . PHP_EOL;
    }
}
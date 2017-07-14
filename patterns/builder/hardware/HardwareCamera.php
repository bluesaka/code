<?php

namespace builder\hardware;

class HardwareCamera implements Hardware
{

    public function produce($pixel = '')
    {
        echo "硬件 - 相机像素：$pixel" . PHP_EOL;
    }
}
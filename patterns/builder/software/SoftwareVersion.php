<?php

namespace builder\software;

class SoftwareVersion implements Software
{
    public function produce($version = '')
    {
        echo "软件 - 系统版本：$version" . PHP_EOL;
    }
}
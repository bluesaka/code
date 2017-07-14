<?php

namespace builder\software;

class SoftwareOS implements Software
{
    public function produce($os = '')
    {
        echo "软件 - 操作系统：$os" . PHP_EOL;
    }
}
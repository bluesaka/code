<?php

namespace builder;

use builder\hardware\HardwareCamera;
use builder\hardware\HardwareScreen;
use builder\software\SoftwareOS;
use builder\software\SoftwareVersion;

class ComputerBuilder implements BuilderInterface
{
    public function __construct($name, $hardware = [], $software = [])
    {
        echo "--- {$name}的配置 ---" .PHP_EOL;
        $this->hardware($hardware);
        $this->software($software);
    }

    public function hardware($hardware = [])
    {
        foreach ($hardware as $name => $value) {
            switch ($name) {
                case 'screen':
                    (new HardwareScreen())->produce($value);
                    break;
                case 'camera':
                    (new HardwareCamera())->produce($value);
                    break;
                default:
                    break;
            }
        }
    }

    public function software($software = [])
    {
        foreach ($software as $name => $value) {
            switch ($name) {
                case 'os':
                    (new SoftwareOS())->produce($value);
                    break;
                case 'version':
                    (new SoftwareVersion())->produce($value);
                    break;
                default:
                    break;
            }
        }
    }
}
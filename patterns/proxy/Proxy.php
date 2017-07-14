<?php

namespace proxy;

class Proxy
{
    private $shoe;
    private $shoeType;

    public function __construct($shoeType = '')
    {
        $this->shoeType = $shoeType;
    }

    public function produce()
    {
        switch ($this->shoeType) {
            case 'nike':
                echo "使用代理：" . PHP_EOL;
                $this->shoe = new ShoeNike();
                break;
            case 'adidas':
                echo "使用代理：" . PHP_EOL;
                $this->shoe = new ShoeAdidas();
                break;
            default:
                echo "not found：" . $this->shoeType . PHP_EOL;
                break;
        }

        if ($this->shoe)
            $this->shoe->produce();
    }
}
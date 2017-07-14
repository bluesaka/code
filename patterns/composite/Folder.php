<?php

namespace composite;

class Folder implements CompositeInterface
{
    private $subset = [];
    private $name = '';

    public function __construct($name)
    {
        $this->name = "文件夹" . $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function add(CompositeInterface $composite)
    {
        if (in_array($composite, $this->subset))
            return;
        $this->subset[] = $composite;
    }

    public function delete(CompositeInterface $composite)
    {
        $key = array_search($composite, $this->subset);
        if ($key === false) {
            echo "要删除的不存在：" . $composite->getName() . PHP_EOL;
            return;
        }
        unset($this->subset[$key]);
    }

    public function operate()
    {
        echo "文件夹不支持写入和读取内容" . PHP_EOL;
    }

    public function printSubset($counter = 0)
    {
        if (!$counter++)
            echo "打印" . $this->getName() . "的内容：" . PHP_EOL;
        foreach ($this->subset as $sub) {
            $tab = $this->getTab($counter);
            /**@var CompositeInterface $sub */
            if ($sub instanceof self) {
                echo $tab . $sub->getName() . PHP_EOL;
                $sub->printSubset($counter);
            } else {
                echo $tab . $sub->getName() . PHP_EOL;
            }
        }
    }

    private function getTab($counter = 0)
    {
        $tab = '';
        for ($i = 1; $i < $counter; ++ $i) {
            $tab .= "\t";
        }
        return $tab;
    }
}
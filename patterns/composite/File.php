<?php

namespace composite;

class File implements CompositeInterface
{
    private $name = '';
    private $content = '';

    public function __construct($name)
    {
        $this->name = "文件" . $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function add(CompositeInterface $composite)
    {
        echo "文件不支持增加文件" . PHP_EOL;
    }

    public function delete(CompositeInterface $composite)
    {
        echo "文件不支持删除文件" . PHP_EOL;
    }

    public function operate($type = '', $content = '')
    {
        switch ($type) {
            case 'read':
                echo $this->content . PHP_EOL;
                break;
            case 'write':
                $this->content = $content;
                break;
            default:
                echo "不支持的文件操作类型";
        }
    }

    public function printSubset($first = true)
    {
        echo "文件不支持打印文件结构" . PHP_EOL;
    }
}
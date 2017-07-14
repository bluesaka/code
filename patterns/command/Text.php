<?php

namespace command;

class Text
{
    public function create($filename)
    {
        echo "创建了文件：{$filename}" . PHP_EOL;
    }

    public function write($filename, $content)
    {
        echo "写入文件：{$filename}，内容：{$content}" . PHP_EOL;
    }

    public function save($filename)
    {
        echo "保存了文件：{$filename}" . PHP_EOL;
    }
}
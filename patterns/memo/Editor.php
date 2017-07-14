<?php

namespace memo;

class Editor
{
    private $content = '';
    private $memo;

    public function __construct($content = '')
    {
        $this->content = $content;
        $this->memo = new Memo();
        $this->save();
    }

    // 读取
    public function read()
    {
        echo "内容为：" . $this->content . PHP_EOL;
    }

    // 写入
    public function write($content = '')
    {
        $this->content .= $content;
    }

    //  保存上下文
    public function save()
    {
        $this->memo->add(clone $this);
    }

    // 撤销
    public function undo()
    {
        $undo = $this->memo->undo();
        $this->content = $undo->content;
    }

    // 重做
    public function redo()
    {
        $redo = $this->memo->redo();
        $this->content = $redo->content;
    }

    public function test()
    {
        var_dump($this->memo);
    }
}
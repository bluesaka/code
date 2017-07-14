<?php

namespace memo;

class Memo
{
    private $memoList = [];

    public function add(Editor $editor)
    {
        $this->memoList[] = $editor;
    }

    // 撤销
    public function undo()
    {
        return array_pop($this->memoList);
    }

    // 重做
    public function redo()
    {
        return array_shift($this->memoList);
    }
}
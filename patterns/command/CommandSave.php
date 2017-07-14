<?php

namespace command;

class CommandSave implements CommandInterface
{
    private $text;
    private $params = [];

    public function __construct(Text $text, $params = [])
    {
        $this->text = $text;
        $this->params = $params;
    }

    public function execute()
    {
        $this->text->save($this->params['filename']);
    }

}
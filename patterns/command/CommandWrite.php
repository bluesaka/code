<?php

namespace command;

class CommandWrite implements CommandInterface
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
        $this->text->write($this->params['filename'], $this->params['content']);
    }

}
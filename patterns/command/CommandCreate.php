<?php

namespace command;

class CommandCreate implements CommandInterface
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
        $this->text->create($this->params['filename']);
    }

}
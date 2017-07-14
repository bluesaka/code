<?php

namespace command;

class Console
{
    private $commands = [];

    public function add(CommandInterface $command)
    {
        $this->commands[] = $command;
    }

    public function run()
    {
        foreach ($this->commands as $command) {
            /**@var CommandInterface $command */
            $command->execute();
        }
    }
}
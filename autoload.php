<?php

spl_autoload_register('autoload');

function autoload($class)
{
    include dirname($_SERVER['SCRIPT_FILENAME']) . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
}
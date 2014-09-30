<?php
class AutoLoader
{
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'), true);
    }

    public function loadClass($class)
    {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $filename = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($filename)) {
            include_once($filename);
        };
    }

}
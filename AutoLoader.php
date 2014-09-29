<?php
class AutoLoader
{
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'), true);
    }

    public function loadClass($class)
    {
        $filename = __DIR__ . $class . 'php';
        if (file_exists($filename)) {
            include $filename;
        };
    }

}
<?php
namespace Globals\Classes\Exceptions\Db;

class BadConfigException extends \Exception
{
    public function __construct($configKey)
    {
        $this->message = sprintf('Bad or not exists %s configuration value for db connection', $configKey);
        parent::__construct($this->message);
    }
} 
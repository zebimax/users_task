<?php

use Globals\Classes\Exceptions\Db\BadConfigException;

class Db
{
    private static $db;

    /** @var Mysqli */
    private $connection;

    private function __construct($host, $port, $user, $password, $dbname)
    {
        $this->connection = new \Mysqli($host, $user, $password, $dbname, $port);
    }

    public static function getDb(array $configs = [])
    {
        if (!self::$db) {
            self::$db = new self(
                self::getDbConfig('host', $configs),
                self::getDbConfig('port', $configs),
                self::getDbConfig('user', $configs),
                self::getDbConfig('password', $configs),
                self::getDbConfig('db_name', $configs)
            );
        }
        return self::$db;
    }

    private static function getDbConfig($configKey, array $configs)
    {
        $value = !isset($configs[$configKey]) ? $configs[$configKey] : null;

        if (!$value && $configKey !== 'password') {
            throw new BadConfigException($configKey);
        }
        return $value;
    }

    public function query($query)
    {
        return $this->connection->query($query);
    }
} 
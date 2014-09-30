<?php
namespace Globals\Classes;
use Globals\Classes\App\Db\ModelsFactory;
use Globals\Classes\Exceptions\Db\BadConfigException;
use PDO;

class Db
{
    private static $db;

    /** @var Pdo */
    private $connection;

    private function __construct($host, $port, $user, $password, $dbname)
    {
        $this->connection = new \Pdo(
            "mysql:host={$host};port={$port};dbname={$dbname}",
            $user, $password, [PDO::ATTR_PERSISTENT => false]
        );
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
        $value = isset($configs[$configKey]) ? $configs[$configKey] : null;

        if (!$value && $configKey !== 'password') {
            throw new BadConfigException($configKey);
        }
        return $value;
    }

    /**
     * @param $modelName
     * @return \Globals\Classes\App\Db\AbstractModel
     * @throws \Globals\Classes\Exceptions\Db\BadModelException
     */
    public function getModel($modelName)
    {
        return ModelsFactory::create($modelName, $this);
    }

    public function getQuery($query)
    {
        return $this->connection->prepare($query);
    }

    public function execute($query, $params = [], $fetchStyle = PDO::FETCH_ASSOC)
    {
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute($params);
        return $PDOStatement->fetch($fetchStyle);
    }

    /**
     * @return Pdo
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
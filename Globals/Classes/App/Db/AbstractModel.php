<?php
namespace Globals\Classes\App\Db;

use Globals\Classes\Db;
use PDO;

abstract class AbstractModel
{
    private $fields = [];
    protected $tableName;
    protected $db;

    protected $joinedModels = [];

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function getBy(array $criteria, $limit = null)
    {
        $where = $limitStr = '';
        $params = [];
        foreach ($criteria as $condition => $val) {
            if (!$where) {
                $where .= ' WHERE';
            } else {
                $where .= ' AND';
            }
            //$where .= sprintf(' (%s = %s)', $condition, $val);
            $where .= sprintf(' (`%s` = ?)', $condition);

            $params[] = $val;
        }
        //$limitStr = (int)$limit ? sprintf(' LIMIT %s', $limit) : '';
        $limitStr = '';
        if ((int) $limit) {
            $limitStr = ' LIMIT ?';
            $params[] = (int)$limit;
        }
        $query = sprintf('SELECT * from `%s`%s%s', $this->tableName, $where, $limitStr);
        $PDOStatement = $this->db->getConnection()->prepare($query);
        $PDOStatement->execute($params);
        return $PDOStatement->fetch(PDO::FETCH_ASSOC);
    }

    protected function get($id)
    {
        return $this->getBy(['id' => $id, 'deleted' => false]);
    }

    /**
     * @param array $fields
     */
    private function initFields(array $fields)
    {
        $this->fields = $fields;
    }
} 
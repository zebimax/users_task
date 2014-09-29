<?php
namespace Globals\Classes\App\Db;
abstract class Model
{
    private $fields = [];
    protected $tableName;
    protected $db;

    public function __construct(\Db $db)
    {
        $this->initFields($fields);
        $this->db = $db;
    }

    public function get($id)
    {

    }

    private function getIdField()
    {

    }

    /**
     * @param array $fields
     */
    private function initFields(array $fields)
    {
        $this->fields = $fields;
    }
} 
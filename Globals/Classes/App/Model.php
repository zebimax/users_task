<?php
namespace Globals\Classes\App;
abstract class Model
{
    private $fields = [];
    private $tableName;
    protected $db;

    public function __construct(array $fields)
    {
        $this->initFields($fields);
        $this->db = \App::getApp()->getDb();
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
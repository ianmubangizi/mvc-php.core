<?php

namespace Mubangizi\Models;

use PDO;
use stdClass;
use Mubangizi\Database;

abstract class Entity
{
    public $id;
    protected $table;

    public function __construct($table, $id = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        $this->table = $table;
    }

    public abstract static function map(stdClass $entity);

    public function id_or_default($id)
    {
        return !isset($id) && isset($this->id) ? $this->id : ($id ?: 0);
    }

    /** @noinspection SqlResolve
     * @return stdClass | bool
     */
    public function find_by_id($id)
    {
        $result = $this->query("SELECT * FROM $this->table WHERE id = $id;");
        return isset($result[0]) ? $result[0] : false;
    }

    public function get_by_id($id)
    {
        return $this->map($this->find_by_id($id));
    }

    public function get_all()
    {
        return $this->query("SELECT * FROM $this->table;");
    }

    public static function get_all_from($table)
    {
        return self::query("SELECT * FROM $table;");
    }


    public function all()
    {
        $items = array();
        $result = $this->get_all();
        if (sizeof($result) >= 1) {
            foreach ($result as $key => $obj) {
                $items[$key] = $this->map($obj);
            }
        }
        return $items;
    }

    /** @noinspection SqlResolve */
    public function delete($id)
    {
        return Database::make_connection()->exec("DELETE FROM $this->table WHERE id = $id;");
    }

    public static function query($statement)
    {
        return Database::make_connection()->query($statement)->fetchAll(PDO::FETCH_CLASS);
    }


    public function insert(array $fields)
    {
        list("key" => $columns, "value" => $values) = insert_string($fields, sizeof($fields));
        return Database::make_connection()->exec("INSERT INTO $this->table $columns VALUES $values;");
    }

    public function update(array $fields, $cond)
    {
        $string = update_string($fields, sizeof($fields));
        return Database::make_connection()->exec("UPDATE $this->table SET $string WHERE $cond;");
    }
}

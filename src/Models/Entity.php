<?php

namespace Mubangizi\Models;

use PDO;
use Mubangizi\Database;

abstract class Entity
{
    protected $id;
    protected $table;

    public function __construct($id, $table_name)
    {
        if (isset($id)) {
            $this->id = $id;
        }
        $this->table = $table_name;
        $this->conn = Database::make_connection();
    }

    public function id_or_default($id)
    {
        return !isset($id) && isset($this->id) ? $this->id : ($id ?: 0);
    }

    public function delete($id)
    {
        return Database::make_connection()->exec("DELETE FROM $this->table  WHERE id = $id;");
    }

    public function select($statement)
    {
        return Database::make_connection()->query($statement)->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert(array $fields)
    {
        $string = insert_string($fields, sizeof($fields));
        return Database::make_connection()->exec("INSERT INTO $this->table ${string['key']}  VALUES ${string['value']};");
    }

    public function update(array $fields, $cond)
    {
        $string = update_string($fields, sizeof($fields));
        return Database::make_connection()->exec("UPDATE $this->table SET $string WHERE $cond;");
    }
}

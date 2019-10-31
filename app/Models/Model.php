<?php

namespace App\Models;

use Flight;

abstract class Model
{
    protected $table;

    protected $errors = [];

    public function errors()
    {
        return $this->errors;
    }

    public function delete($id)
    {
        Flight::db()->delete($this->table, ['id' => $id]);
    }
}
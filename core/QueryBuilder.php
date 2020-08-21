<?php

namespace Core;

abstract class QueryBuilder
{
    protected $dbh;

    protected $table;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function get()
    {
        $query = "SELECT * FROM {$this->table}";

        $stmt = $this->dbh->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}
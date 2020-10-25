<?php

namespace Core\Database;

class QueryBuilder
{
    /**
     * @var \PDO
     */
    protected $dbh;

    /**
     * @var string
     */
    protected $table;


    public function __construct($table = null)
    {
        $this->table = $table;

        $this->dbh = app()->getSingleton('connection');
    }

    public function get(array $columns = ['*'])
    {
        $columns = implode(", ", $columns);

        $query = "SELECT {$columns} FROM {$this->table}";

        $stmt = $this->dbh->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function first(array $columns = ['*'])
    {
        $columns = implode(", ", $columns);

        $query = "SELECT {$columns} FROM {$this->table} LIMIT 1";

        $stmt = $this->dbh->prepare($query);

        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function find(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";

        $stmt = $this->dbh->prepare($query);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    private function getQuestionMarks(int $length): string
    {
        $questionMarks = '';
        for($i = 0; $i < $length; $i++) {
            $questionMarks .= $i ? ', ?': '?';
        }
        return $questionMarks;
    }
}
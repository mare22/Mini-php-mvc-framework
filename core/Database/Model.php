<?php

namespace Core\Database;

class Model
{
    /**
     * @var static
     */
    protected $table;



    public function query()
    {
        return new QueryBuilder($this->table);
    }


    public function __call($method, $arguments)
    {
        return $this->query()->$method(...$arguments);
    }


    public static function __callStatic($method, $arguments)
    {
        return (new static)->query()->$method(...$arguments);
    }
}
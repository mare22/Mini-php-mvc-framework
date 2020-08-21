<?php

namespace Core;

class Connection
{
    /**
     * Make mysql connection and return pdo object.
     *
     * @param array $db
     * @return \PDO
     * @throws \Exception
     */
    public static function make(array $db)
    {
        $dsn = "mysql:host={$db['db_hostname']};dbname={$db['db_name']}";


        try {

            return new \PDO($dsn, $db['db_username'], $db['db_password'], $db['db_options']);

        } catch (\PDOException $exception) {

            throw new \Exception($exception->getMessage());

        }
    }
}
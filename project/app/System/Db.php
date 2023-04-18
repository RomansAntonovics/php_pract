<?php

namespace App\System;

use \PDO;

class Db
{
    /** @var array */
    private $dbConfig;

    /** @var PDO */
    public $connection;

    public function __construct(array $dbConfig)
    {
        $this->dbConfig = $dbConfig;
        $this->createConnection();
    }

    private function createConnection()
    {
        $host = $this->dbConfig['host'];
        $db = $this->dbConfig['db'];
        $charset = $this->dbConfig['charset'];
        $port = $this->dbConfig['port'];
        $user = $this->dbConfig['user'];
        $pass = $this->dbConfig['pass'];

//        pre($this->dbConfig);
//        exit;

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {

            pre(array(
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ));

            exit;
        }

        $this->connection = $pdo;
    }

    public function insert($sql, $params = array())
    {
        $query = $this->connection->prepare($sql);
        $query->execute($params);

        return $this->connection->lastInsertId();
    }

    public function select($sql, $params = array())
    {
        $query = $this->connection->prepare($sql);
        $query->execute($params);
        return $query->fetchAll();
    }

    public function selectOne($sql, $params = array())
    {
        $query = $this->connection->prepare($sql);
        $query->execute($params);
        return $query->fetch();
    }

    public function update($sql, $params = array())
    {
        $query = $this->connection->prepare($sql);

        if($query->execute($params)) {
            return true;
        }

        return false;
    }

    public function delete($sql, $params)
    {
        $query = $this->connection->prepare($sql);

        if($query->execute($params)) {
            return true;
        }

        return false;
    }


}
<?php

class Connection
{
    /**
     *
     * @var pdo
     */
    static protected  $_db = null;

    /**
     * @param $host
     * @param $user
     * @param $pass
     * @param $dbname
     *
     * @return PDO
     * @throws Exception
     */
    static public function createConnection($host, $user, $pass, $dbname)
    {
        $dns = "mysql:dbname={$dbname};host={$host}";
        try {
            $pdo = new PDO($dns, $user, $pass);
        } catch (PDOException $e) {
            throw new Exception ("Error to connect to DB");
        }
        $pdo->query("SET NAMES UTF8");
        return $pdo;
    }


    /**
     * Получить объект соеденения
     *
     * @return pdo
     */
    static public function getConnection()
    {
        return self::$_db;
    }

    /**
     * Установить объект соеденения
     *
     * @param pdo $connection
     */
    static public function setConnection(PDO $connection)
    {
        self::$_db = $connection;
    }

}
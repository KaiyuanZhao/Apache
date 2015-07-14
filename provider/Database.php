<?php

/**
 * Singleton for Database Class
 * Created by PhpStorm.
 * User: Kaiyuan
 * Date: 2015/7/13
 * Time: 22:41
 */
class Database
{
    /**
     * @var Database
     */
    private static $database = NULL;
    /**
     * @var mysqli
     */
    private $connection;

    /**
     * Database constructor.
     */
    private function __construct()
    {
        $this->connection = new mysqli(constant("SERVER_NAME"), constant("USERNAME"), constant("PASSWORD"), constant("DATABASE"));
    }

    /**
     * get Singleton class
     * @return Database
     */
    public static function getInstance()
    {
        if (self::$database == NULL)
            self::$database = new Database();
        return self::$database;
    }

    /**
     * Database destruct
     */
    function __destruct()
    {
        $this->connection->close();
    }

    /**
     * @return mysqli
     */
    public function getConnection()
    {
        return $this->connection;
    }

}
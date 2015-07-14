<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 17:01
 */
class UserAction
{

    public static $LOGIN_FAIL = -1;
    public static $REGISTER_FAIL = -1;
    public static $REGISTER_EMAIL_DUPLICATE = -2;

    /**
     * login function
     * @param $email String
     * @param $password String
     * @return User|Integer login user or error code
     */
    public static function login($email, $password)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "select * from user where email = ? and password = ?";
        $result = $connection->prepare($query);
        $result->bind_param("ss", $email, $password);
        $execute = $result->execute();
        if (!$execute)
            return self::$LOGIN_FAIL;
        $result->bind_result($userId, $email, $password, $username, $nickname, $department, $location, $description);
        while ($result->fetch())
            return new User($userId, $email, $username, $nickname, $department, $location, $description);
        return self::$LOGIN_FAIL;
    }

    /**
     * register function
     * @param $email String
     * @param $password String
     * @param $username String
     * @param $nickname String
     * @param $department String
     * @param $location String
     * @param $description String
     * @return User|Integer register user or error code
     */
    public static function register($email, $password, $username, $nickname, $department, $location, $description)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "insert into user (email, password, username, nickname, department, location, description)
          values (?, ?, ?, ?, ?, ?, ?)";
        $result = $connection->prepare($query);
        $result->bind_param("sssssss", $email, $password, $username, $nickname, $department, $location, $description);
        $execute = $result->execute();
        if (!$execute)
            return self::$REGISTER_EMAIL_DUPLICATE;

        static $query_user = "select * from user where email = ?";
        $result = $connection->prepare($query_user);
        $result->bind_param("s", $email);
        $execute = $result->execute();
        if (!$execute)
            return self::$REGISTER_FAIL;
        $result->bind_result($userId, $email, $password, $username, $nickname, $department, $location, $description);
        while ($result->fetch())
            return new User($userId, $email, $username, $nickname, $department, $location, $description);
        return self::$REGISTER_FAIL;
    }

}
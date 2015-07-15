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
    public static $MODIFY_FAIL = -1;
    public static $MODIFY_NO_USER = -2;
    public static $MODIFY_NO_CHANGE = -3;
    public static $CHANGE_PASSWORD_FAIL = -1;
    public static $CHANGE_PASSWORD_NO_USER = -2;
    public static $CHANGE_PASSWORD_PREVIOUS_PASSWORD_WRONG = -3;

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
        $result->bind_result($userId, $email, $password, $username, $nickname, $department, $location, $description, $icon);
        while ($result->fetch())
            return new User($userId, $email, $username, $nickname, $department, $location, $description, $icon);
        $result->close();
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
    public static function register($email, $password, $username, $nickname, $department, $location, $description, $icon)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "insert into user (email, password, username, nickname, department, location, description, icon)
          values (?, ?, ?, ?, ?, ?, ?, ?)";
        $result = $connection->prepare($query);
        $result->bind_param("ssssssss", $email, $password, $username, $nickname, $department, $location, $description, $icon);
        $execute = $result->execute();
        if (!$execute)
            return self::$REGISTER_EMAIL_DUPLICATE;
        $result->close();

        static $query_user = "select * from user where email = ?";
        $result = $connection->prepare($query_user);
        $result->bind_param("s", $email);
        $execute = $result->execute();
        if (!$execute)
            return self::$REGISTER_FAIL;
        $result->bind_result($userId, $email, $password, $username, $nickname, $department, $location, $description, $icon);
        while ($result->fetch())
            return new User($userId, $email, $username, $nickname, $department, $location, $description, $icon);
        $result->close();
        return self::$REGISTER_FAIL;
    }

    public static function modify($userId, $username, $nickname, $department, $location, $description, $icon)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "select email from user where userId = ?";
        $result = $connection->prepare($query);
        $result->bind_param("s", $userId);
        $execute = $result->execute();
        if (!$execute)
            return self::$MODIFY_FAIL;
        $result->bind_result($email);
        if (!$result->fetch())
            return self::$MODIFY_NO_USER;
        $result->close();

        static $update_user = "update `user` set `username`=?,`nickname`=?,
            `department`=?,`location`=?,`description`=?,`icon`=? WHERE userId=?";
        $result = $connection->prepare($update_user);
        $result->bind_param("sssssss", $username, $nickname, $department, $location, $description, $icon, $userId);
        $execute = $result->execute();
        if (!$execute)
            return self::$MODIFY_FAIL;
        if ($result->affected_rows == 0)
            return self::$MODIFY_NO_CHANGE;
        $result->close();
        return new User($userId, $email, $username, $nickname, $department, $location, $description, $icon);

    }

    public static function changePassword($userId, $previousPassword, $newPassword)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "select userId from user where userId = ?";
        $result = $connection->prepare($query);
        $result->bind_param("s", $userId);
        $execute = $result->execute();
        if (!$execute)
            return self::$CHANGE_PASSWORD_FAIL;
        if (!$result->fetch())
            return self::$CHANGE_PASSWORD_NO_USER;
        $result->close();

        static $update_password = "update `user` set `password`=? where userId=? and password=?";
        $result = $connection->prepare($update_password);
        $result->bind_param("sss", $newPassword, $userId, $previousPassword);
        $execute = $result->execute();
        if (!$execute)
            return self::$CHANGE_PASSWORD_FAIL;
        if ($result->affected_rows == 0)
            return self::$CHANGE_PASSWORD_PREVIOUS_PASSWORD_WRONG;
        $result->close();
        return true;
    }

}
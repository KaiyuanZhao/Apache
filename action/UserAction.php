<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 17:01
 */
class UserAction
{

    /**
     * login function
     * @param $email String
     * @param $password String
     * @return User|Integer login user or error code
     */
    public function login($email, $password)
    {
        return new User(0, "zhaokaiyuan@baixing.net", "赵开元", "Kyle", "暑期实习生", "1806", "");
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
    public function register($email, $password,  $username, $nickname, $department, $location, $description)
    {
        return new User(0, $email, $username, $nickname, $department, $location, $description);
    }

}
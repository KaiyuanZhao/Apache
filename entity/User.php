<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 16:21
 */
class User
{

    /**
     * @var Integer
     */
    private $userId;
    /**
     * @var String
     */
    private $email;
    /**
     * @var String
     */
    private $username;
    /**
     * @var String
     */
    private $nickname;
    /**
     * @var String
     */
    private $department;
    /**
     * @var String
     */
    private $location;
    /**
     * @var String
     */
    private $description;

    /**
     * User constructor.
     * @param $userId
     * @param $email
     * @param $username
     * @param $nickname
     * @param $department
     * @param $location
     * @param $description
     */
    public function __construct($userId, $email, $username, $nickname, $department, $location, $description)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->username = $username;
        $this->nickname = $nickname;
        $this->department = $department;
        $this->location = $location;
        $this->description = $description;
    }

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    function __get($name)
    {
        if (isset($this->$name)) {
            return ($this->$name);
        } else {
            return (NULL);
        }
    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param $name string
     * @param $value mixed
     * @return void
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    function __set($name, $value)
    {
        $this->$name = $value;
    }

}
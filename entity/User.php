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
    public $username;
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
    public $location;
    /**
     * @var String
     */
    private $description;
    /**
     * @var String
     */
    private $icon;

    /**
     * User constructor.
     * @param int $userId
     * @param String $email
     * @param String $username
     * @param String $nickname
     * @param String $department
     * @param String $location
     * @param String $description
     * @param $icon
     */
    public function __construct($userId, $email, $username, $nickname, $department, $location, $description, $icon)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->username = $username;
        $this->nickname = $nickname;
        $this->department = $department;
        $this->location = $location;
        $this->description = $description;
        $this->icon = $icon;
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

}
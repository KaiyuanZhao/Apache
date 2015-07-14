<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 16:32
 */
class Order
{
    /**
     * @var Integer
     */
    private $orderId;
    /**
     * @var User
     */
    private $user;
    /**
     * @var String
     */
    private $createdTime;
    /**
     * @var String
     */
    private $date;

    /**
     * Order constructor.
     * @param $orderId
     * @param $user
     * @param $createdTime
     * @param $date
     */
    public function __construct($orderId, $user, $createdTime, $date)
    {
        $this->orderId = $orderId;
        $this->user = $user;
        $this->createdTime = $createdTime;
        $this->date = $date;
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
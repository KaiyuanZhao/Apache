<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 16:55
 */
class MealDay
{

    /**
     * @var Meal
     */
    private $meal;
    /**
     * @var String
     */
    private $date;

    /**
     * MealDay constructor.
     * @param $meal String
     * @param $date String
     */
    public function __construct($meal, $date)
    {
        $this->meal = $meal;
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
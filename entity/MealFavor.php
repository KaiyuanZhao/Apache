<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 16:58
 */
class MealFavor
{

    /**
     * @var Meal
     */
    public $meal;
    /**
     * @var Integer
     */
    public $favorCount;

    /**
     * MealFavor constructor.
     * @param $meal
     * @param $favorCount
     */
    public function __construct($meal, $favorCount)
    {
        $this->meal = $meal;
        $this->favorCount = $favorCount;
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
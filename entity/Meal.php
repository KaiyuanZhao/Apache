<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 16:49
 */
class Meal
{

    /**
     * @var String
     */
    public $mealId;
    /**
     * @var String
     */
    public $mealName;

    /**
     * Meal constructor.
     * @param $mealId
     * @param $mealName
     */
    public function __construct($mealId, $mealName)
    {
        $this->mealId = $mealId;
        $this->mealName = $mealName;
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
<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 上午10:13
 */


class mealsRes {
    public $success;
    public $errormessage;
    public $meals= array();

    function __construct($success, $errormessage, $meals)
    {
        $this->success = $success;
        $this->errormessage = $errormessage;
        $this->meals = $meals;
    }

} 
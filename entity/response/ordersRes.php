<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 下午6:46
 */
class ordersRes {
    public $success;
    public $errormessage;
    public $orders= array();

    function __construct($success, $errormessage, $orders)
    {
        $this->success = $success;
        $this->errormessage = $errormessage;
        $this->orders = $orders;
    }

}
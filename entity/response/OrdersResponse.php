<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 下午6:46
 */
class OrdersResponse {
    public $success;
    public $errormessage;
    public $orders;
    public $total;

    /**
     * OrdersResponse constructor.
     * @param $success
     * @param $errormessage
     * @param $orders
     * @param $total
     */
    public function __construct($success, $errormessage, $orders, $total)
    {
        $this->success = $success;
        $this->errormessage = $errormessage;
        $this->orders = $orders;
        $this->total = $total;
    }

}
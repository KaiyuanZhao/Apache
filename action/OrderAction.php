<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 17:01
 */
class OrderAction
{

    /**
     * @param $userId Integer
     * @param $orderId Integer
     * @param $createdTime DateTime
     * @param $date DateTime
     * @return bool|Integer order success or error code
     */
    public function orderMeal($userId, $orderId, $createdTime, $date)
    {
        return true;
    }

    /**
     * @param $orderId String
     * @return bool|INteger cancel success or error code
     */
    public function cancelOrder($orderId)
    {
        return true;
    }

    /**
     * @param $date DateTime
     * @return array|Integer get orders success or error code
     */
    public function getOrders($date)
    {
        return array(new Order(0,new User(0, "zhaokaiyuan@baixing.net", "赵开元", "Kyle", "暑期实习生", "1806", ""), new DateTime(), $date));
    }

}
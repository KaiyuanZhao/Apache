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
     * @param $date DateTime
     * @return bool|Integer order success or error code
     */
    public function orderMeal($userId, $date)
    {
        return true;
    }

    /**
     * @param $userId String
     * @return bool|Integer cancel success or error code
     */
    public function cancelOrder($userId)
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
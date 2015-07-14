<?php

/**
 * Order Entity Class
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 17:01
 */
class OrderAction
{
    public static $ORDER_MEAL_FAIL = -1;
    public static $CANCEL_ORDER_NOT_ORDER_BEFORE = -2;
    public static $GET_ORDERS_FAIL = -3;

    /**
     * @param $userId Integer
     * @return bool|Integer order success or error code
     */
    public static function orderMeal($userId)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "insert into `order` (userId, `date`) values (?, ?)";
        $result = $connection->prepare($query);
        $date = TimeUtils::getCurrentDate();
        $result->bind_param("ss", $userId, $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$ORDER_MEAL_FAIL;
        $result->close();
        return true;
    }

    /**
     * @param $userId Integer
     * @return bool|Integer cancel success or error code
     */
    public static function cancelOrder($userId)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "delete from `order` where userid = ?";
        $result = $connection->prepare($query);
        $result->bind_param("s", $userId);
        $execute = $result->execute();
        if (!$execute)
            return self::$CANCEL_ORDER_NOT_ORDER_BEFOR;
        $result->close();
        return true;
    }

    /**
     * @param $date String
     * @return array|Integer get orders success or error code
     */
    public static function getOrders($date = "")
    {
        if ($date == "")
            $date = TimeUtils::getCurrentDate();
        $connection = Database::getInstance()->getConnection();
        static $query = "select * from `order` natural join user where date = ? order by createTime desc";
        $result = $connection->prepare($query);
        $result->bind_param("s", $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$GET_ORDERS_FAIL;
        $result->bind_result($userId, $orderId, $date, $createTime, $email, $password, $username, $nickname,
            $department, $location, $description);
        $orders = [];
        while ($result->fetch())
            $orders[] = new Order($orderId, new User($userId, $email, $username, $nickname, $department,
                $location, $description), $date, $createTime);
        $result->close();
        return $orders;
    }

}
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
    public static $CANCEL_ORDER_FAIL = -1;
    public static $CANCEL_ORDER_NOT_ORDER_BEFORE = -2;
    public static $GET_ORDERS_FAIL = -1;
    public static $IS_ORDERED_FAIL = -1;

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

        static $query = "delete from `order` where userId = ? and date = ?";
        $result = $connection->prepare($query);
        $date = TimeUtils::getCurrentDate();
        $result->bind_param("ss", $userId, $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$CANCEL_ORDER_FAIL;
        if ($result->affected_rows == 0)
            return self::$CANCEL_ORDER_NOT_ORDER_BEFORE;
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
        static $query = "select * from `order` natural join user where date = ? order by location asc, createTime desc";
        $result = $connection->prepare($query);
        $result->bind_param("s", $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$GET_ORDERS_FAIL;
        $result->bind_result($userId, $orderId, $date, $createTime, $email, $password, $username, $nickname,
            $department, $location, $description, $icon);
        $orders = [];
        while ($result->fetch())
            $orders[] = new Order($orderId, new User($userId, $email, $username, $nickname, $department,
                $location, $description, $icon), $date, $createTime);
        $result->close();
        return $orders;
    }

    /**
     * @param $userId Integer
     * @param string $date
     * @return bool|int is ordered or error code
     */
    public static function isOrdered($userId, $date = "")
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "select * from `order` where userId=? and date=?";
        $result = $connection->prepare($query);
        if ($date == "")
            $date = TimeUtils::getCurrentDate();
        $result->bind_param("ss", $userId, $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$IS_ORDERED_FAIL;
        while ($result->fetch())
            return true;
        $result->close();
        return false;
    }

}
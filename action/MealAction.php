<?php

/**
 *
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 17:01
 */
class MealAction
{

    public static $ADD_MEAL_FAIL = -1;
    public static $ADD_MEAL_MEAL_NAME_DUPLICATE = -2;
    public static $GET_MEALS_FAIL = -1;
    public static $ADD_TODAY_MEAL_FAIL = -1;
    public static $ADD_TODAY_MEAL_NOT_FOUND_MEAL_ID = -2;
    public static $ADD_TODAY_MEAL_MEAL_ID_DUPLICATE = -3;
    public static $FAVOR_FAIL = -1;
    public static $FAVOR_NOT_FOUND_MEAL_ID = -2;
    public static $FAVOR_NOT_ORDER_MEAL = -3;
    public static $FAVOR_DUPLICATE = -4;
    public static $CANCEL_FAVOR_FAIL = -1;
    public static $CANCEL_FAVOR_NOT_ORDER_MEAL = -2;
    public static $CANCEL_FAVOR_NOT_FAVOR_BEFOR = -3;
    public static $GET_TOP_MEALS_FAIL = -1;

    /**
     * @param $mealName String
     * @return bool|Integer success or error code
     */
    public static function addMeal($mealName)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "insert into meal (mealName) values (?)";
        $result = $connection->prepare($query);
        $result->bind_param("s", $mealName);
        $execute = $result->execute();
        if (!$execute)
            return self::$ADD_MEAL_MEAL_NAME_DUPLICATE;
        $result->close();
        return true;
    }

    /**
     * @return array|bool get all the meals or fail
     */
    public static function getMeals()
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "select * from meal";
        $result = $connection->prepare($query);
        $execute = $result->execute();
        if (!$execute)
            return self::$GET_MEALS_FAIL;
        $result->bind_result($mealId, $mealName);
        $meals = [];
        while ($result->fetch())
            $meals[] = new Meal($mealId, $mealName);
        $result->close();
        return $meals;
    }

    /**
     * @param $mealId String
     * @return bool|Integer success or error code
     */
    public static function addTodayMeal($mealId)
    {
        $connection = Database::getInstance()->getConnection();
        static $queryMealId = "select * from meal where mealId = ?";
        $result = $connection->prepare($queryMealId);
        $result->bind_param("s", $mealId);
        $execute = $result->execute();
        if (!$execute)
            return self::$ADD_TODAY_MEAL_FAIL;
        if (!$result->fetch())
            return self::$ADD_TODAY_MEAL_NOT_FOUND_MEAL_ID;
        $result->close();

        static $query = "insert into mealrecord (date, mealId) VALUES (current_date, ?)";
        $result = $connection->prepare($query);
        $result->bind_param("s", $mealId);
        $execute = $result->execute();
        if (!$execute)
            return self::$ADD_TODAY_MEAL_MEAL_ID_DUPLICATE;
        $result->close();
        return true;
    }

    /**
     * @param $date String
     * @return array|bool get $date's meals or fail
     */
    public static function getTodayMeals($date)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "select * from mealrecord where date = ?";
        $result = $connection->prepare($query);
        $result->bind_param("s", $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$GET_MEALS_FAIL;
        $result->bind_result($mealId, $mealName);
        $meals = [];
        while ($result->fetch())
            $meals[] = new Meal($mealId, $mealName);
        $result->close();
        return $meals;
    }

    /**
     * @param $userId String
     * @param $mealId String
     * @return bool|Integer success or error code
     */
    public static function favor($userId, $mealId)
    {
        $connection = Database::getInstance()->getConnection();

        static $queryTodayMealId = "select * from mealrecord where mealId = ? and `date` = ?";
        $result = $connection->prepare($queryTodayMealId);
        $date = TimeUtils::getCurrentDate();
        $result->bind_param("ss", $mealId, $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$FAVOR_FAIL;
        if (!$result->fetch())
            return self::$FAVOR_NOT_FOUND_MEAL_ID;
        $result->close();

        static $queryTodayOrder = "select orderId from `order` where userId = ? and `date` = ?";
        $result = $connection->prepare($queryTodayOrder);
        $result->bind_param("ss", $userId, $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$FAVOR_FAIL;
        $result->bind_result($orderId);
        if (!$result->fetch())
            return self::$FAVOR_NOT_ORDER_MEAL;
        $result->close();

        static $query = "insert into mealfavor VALUES (?, ?)";
        $result = $connection->prepare($query);
        $result->bind_param("ss", $orderId, $mealId);
        $execute = $result->execute();
        if (!$execute)
            return self::$FAVOR_DUPLICATE;
        $result->close();
        return true;
    }

    /**
     * @param $userId String
     * @param $mealId String
     * @return bool|Integer success or error code
     */
    public static function cancelFavor($userId, $mealId)
    {
        $connection = Database::getInstance()->getConnection();

        static $queryTodayOrder = "select orderId from `order` where userId = ? and `date` = ?";
        $result = $connection->prepare($queryTodayOrder);
        $date = TimeUtils::getCurrentDate();
        $result->bind_param("ss", $userId, $date);
        $execute = $result->execute();
        if (!$execute)
            return self::$CANCEL_FAVOR_FAIL;
        $result->bind_result($orderId);
        if (!$result->fetch())
            return self::$CANCEL_FAVOR_NOT_ORDER_MEAL;
        $result->close();

        static $query = "delete from mealfavor where orderId = ? and mealId = ?";
        $result = $connection->prepare($query);
        $result->bind_param("ss", $orderId, $mealId);
        $execute = $result->execute();
        if (!$execute)
            return self::$CANCEL_FAVOR_NOT_FAVOR_BEFOR;
        $result->close();
        return true;
    }

    /**
     * @return array|Integer top ten favourite meal or error code
     */
    public static function getTopTenMeals()
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "select mealId, mealName, count(mealId) as count from mealfavor natural join meal group by mealId";
        $result = $connection->prepare($query);
        $execute = $result->execute();
        if (!$execute)
            return self::$GET_TOP_MEALS_FAIL;
        $result->bind_result($mealId, $mealName, $count);
        $meals = [];
        while ($result->fetch())
            $meals[] = new MealFavor(new Meal($mealId, $mealName), $count);
        $result->close();
        return $meals;
    }

}
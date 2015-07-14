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
    public static $ADD_TODAY_MEAL_NOT_FOUND_MEAL_ID = -1;

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
        return $meals;
    }

    /**
     * @param $mealId String
     * @return bool|Integer success or error code
     */
    public static function addTodayMeal($mealId)
    {
        $connection = Database::getInstance()->getConnection();

        static $query = "insert into mealrecord (date, mealId) VALUES (current_date, ?)";
        $result = $connection->prepare($query);
        $result->bind_param("s", $mealId);
        $execute = $result->execute();
        if (!$execute)
            return self::$ADD_TODAY_MEAL_NOT_FOUND_MEAL_ID;
        return true;
    }

    /**
     * @param $date String
     * @return array|bool get $date's meals or fail
     */
    public static function getTodayMeals($date)
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
        return $meals;
        return array(new Meal(0, "糖醋里脊"), new Meal(1, "红烧鲤鱼"));
    }

    /**
     * @param $userId String
     * @param $mealId String
     * @return bool|Integer success or error code
     */
    public static function favor($userId, $mealId)
    {
        return true;
    }

    /**
     * @param $userId String
     * @param $mealId String
     * @return bool|Integer success or error code
     */
    public static function cancleFavor($userId, $mealId)
    {
        return true;
    }

    /**
     * @return array|Integer top ten favourite meal or error code
     */
    public static function getTopTenMeals()
    {
        return array(new MealFavor(new Meal(0, "糖醋里脊"), 100), new MealFavor(new Meal(1, "红烧鲤鱼"), 84));
    }

}
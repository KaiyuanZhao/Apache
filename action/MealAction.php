<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/13
 * Time: 17:01
 */
class MealAction
{

    /**
     * @param $mealName String
     * @return bool|Integer success or error code
     */
    public function addMeal($mealName)
    {
        return true;
    }

    /**
     * @param $mealId String
     * @param $date DateTime
     * @return bool|Integer success or error code
     */
    public function addTodayMeal($mealId, $date)
    {
        return true;
    }

    /**
     * @param $mealId String
     * @param $orderId String
     * @return bool|Integer success or error code
     */
    public function favor($mealId, $orderId)
    {
        return true;
    }

    /**
     * @param $mealId String
     * @param $orderId String
     * @return bool|Integer success or error code
     */
    public function cancleFavor($mealId, $orderId)
    {
        return true;
    }

    /**
     * @return array|Integer top ten favourite meal or error code
     */
    public function getTopTen()
    {
        return array(new MealFavor(new Meal(0, "лг╢вюО╪╧"), 100), new MealFavor(new Meal(1, "╨ЛиуюПсЦ"), 84));
    }

}
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
     * @return array|bool get all the meals or fail
     */
    public function getMeals()
    {
        return array(new Meal(0, "糖醋里脊"), new Meal(1, "红烧鲤鱼"));
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
     * @param $date DateTime
     * @return array|bool get $date's meals or fail
     */
    public function getTodayMeals($date)
    {
        return array(new Meal(0, "糖醋里脊"), new Meal(1, "红烧鲤鱼"));
    }

    /**
     * @param $userId String
     * @param $mealId String
     * @return bool|Integer success or error code
     */
    public function favor($userId, $mealId)
    {
        return true;
    }

    /**
     * @param $userId String
     * @param $mealId String
     * @return bool|Integer success or error code
     */
    public function cancleFavor($userId, $mealId)
    {
        return true;
    }

    /**
     * @return array|Integer top ten favourite meal or error code
     */
    public function getTopTenMeals()
    {
        return array(new MealFavor(new Meal(0, "糖醋里脊"), 100), new MealFavor(new Meal(1, "红烧鲤鱼"), 84));
    }

}
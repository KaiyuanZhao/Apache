<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午12:12
 */
header("Content-Type: text/html; charset=utf-8");
require_once '../entity/Meal.php';
require_once '../action/MealAction.php';
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../provider/testFormat.php";
require_once "../entity/response/Response.php";
require_once "../util/TimeUtils.php";
session_start();
$arr = $_POST;
$result = testAddTodayMeal($arr);
$myjson = json_encode($result);
echo $myjson;

function testAddTodayMeal($arr)
{
    $mealId = $arr["meadId"];
    $addTodayMealFlag = MealAction::addTodayMeal($mealId);
    if ($addTodayMealFlag === MealAction::$ADD_TODAY_MEAL_FAIL) {
        $result = new Response(false, "add fail");
        return $result;
    } elseif ($addTodayMealFlag === MealAction::$ADD_TODAY_MEAL_NOT_FOUND_MEAL_ID) {
        $result = new Response(false, "can't find the meat");
        return $result;
    } elseif ($addTodayMealFlag === MealAction::$ADD_TODAY_MEAL_MEAL_ID_DUPLICATE) {
        $result = new Response(false, "the food had been added");
        return $result;
    } elseif ($addTodayMealFlag === true) {
        $result = new Response(true);
        return $result;
    }
}
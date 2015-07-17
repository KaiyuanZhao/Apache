<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 下午1:40
 */
header("Content-Type: text/html; charset=utf-8");
require_once '../entity/Meal.php';
require_once '../action/MealAction.php';
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../provider/testFormat.php";
require_once "../entity/response/Response.php";
session_start();
$arr = $_POST;
$result = testAddMeal($arr);
if ($result instanceof Meal)
    $result = testAddTodayMeal($result->mealId);
$myjson = json_encode($result);
echo $myjson;

function testAddMeal($arr)
{
    $meal = $arr["mealName"];
    $testformat = new testFormat();
    if ($testformat->testMeal($meal)) {
        $flag = MealAction::addMeal($meal);
        if ($flag === MealAction::$ADD_MEAL_MEAL_NAME_DUPLICATE) {
            $result = new Response(false, "the meal had been in the list");
            return $result;
        } elseif ($flag === MealAction::$ADD_MEAL_FAIL) {
            $result = new Response(false, "add meal fail");
            return $result;
        } elseif (isset($flag)) {
            return $flag;
        }
    } else {
        $result = new Response(false, "wrong format");
        return $result;
    }
    return new Response(false, "服务器故障");
}


function testAddTodayMeal($mealId)
{
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
    return new Response(false, "测试");
}
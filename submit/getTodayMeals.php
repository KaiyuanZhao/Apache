<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午12:26
 */
header("Content-Type: text/html; charset=utf-8");
require_once '../entity/Meal.php';
require_once '../action/MealAction.php';
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../provider/testFormat.php";
require_once "../entity/response/mealsRes.php";
require_once "../entity/response/Response.php";
require_once "../util/TimeUtils.php";
session_start();
$arr = $_POST;
$result = testGetTodayMeals();
$myjson = json_encode($result);
echo $myjson;

function testGetTodayMeals()
{
    $date = TimeUtils::getCurrentDate();
    $getTodayMealsFlag = MealAction::getTodayMeals($date);
    if ($getTodayMealsFlag === MealAction::$GET_MEALS_FAIL) {
        $result = new Response(false, "get today meals failed");
        return $result;
    } elseif (isset($getTodayMealsFlag)) {
        $result = new mealsRes(true, "", $getTodayMealsFlag, sizeof($getTodayMealsFlag));
        return $result;
    }
    return new Response(false, "服务器故障");
}
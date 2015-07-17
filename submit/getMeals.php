<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 下午11:39
 */
header("Content-Type: text/html; charset=utf-8");
require_once "../action/MealAction.php";
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../provider/testFormat.php";
require_once "../entity/response/mealsRes.php";
require_once "../entity/Meal.php";
session_start();
$result = testGetMeals();
$myjson = json_encode($result);
echo $myjson;

function testGetMeals()
{
    $getmealFlag = MealAction::getMeals();
    if ($getmealFlag === MealAction::$GET_MEALS_FAIL) {
        $result = new Response(false, "get meals failed");
        return $result;
    } elseif (isset($getmealFlag)) {
        $result = new mealsRes(true, "", $getmealFlag, sizeof($getmealFlag));
        var_dump($result);
        return $result;
    }
    return new Response(false, "服务器故障");
}
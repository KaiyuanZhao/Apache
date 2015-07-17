<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午12:57
 */
header("Content-Type: text/html; charset=utf-8");
require_once '../entity/Meal.php';
require_once '../action/MealAction.php';
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../provider/testFormat.php";
require_once "../entity/response/Response.php";
require_once "../entity/response/mealsRes.php";
require_once "../util/TimeUtils.php";
require_once "../entity/MealFavor.php";
session_start();
$arr = $_POST;
$result = testGetTopTen();
$myjson = json_encode($result);
echo $myjson;

function testGetTopTen()
{
    $getTopTenFlag = MealAction::getTopTenMeals();
    if ($getTopTenFlag === MealAction::$GET_TOP_MEALS_FAIL) {
        $result = new Response(false, "get top ten fail");
        return $result;
    } elseif (isset($getTopTenFlag)) {
        $result = new mealsRes(true, "", $getTopTenFlag, sizeof($getTopTenFlag));
        return $result;
    }
    return new Response(false, "服务器错误");
}
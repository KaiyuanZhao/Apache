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
    session_start();
    $arr = $_POST;
    $result = testGetTopTen();
    $myjson = my_json_encode($result);
    echo $myjson;
    function testGetTopTen()
    {
        $getTopTenFlag = MealAction::getTopTenMeals();
        var_dump($getTopTenFlag);
        if ($getTopTenFlag === MealAction::$GET_TOP_MEALS_FAIL) {
            $result = new Response(false,"get top ten fail");
            return $result;
        } elseif (isset($getTopTenFlag)) {
            $result = new mealsRes(true,"",$getTopTenFlag);
            return $result;
        }
    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
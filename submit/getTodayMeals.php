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
    require_once "../entity/response/Response.php";
    session_start();
    $arr = $_POST;
    $result = testAddMeal($arr);
    $myjson = my_json_encode($result);
    echo $myjson;

    function testGetTodayMeals()
    {
        $date = date('Y-m-d', time());
        $getTodayMealsFlag = MealAction::getTodayMeals($date);
        if ($getTodayMealsFlag == -1) {
            $result = new Response(false,"get today meals failed");
            return $result;
        } elseif (isset($getTodayMealsFlag)) {
            $result = new Response(true);
            return true;
        }
    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
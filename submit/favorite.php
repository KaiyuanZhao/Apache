<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午12:39
 */
    header("Content-Type: text/html; charset=utf-8");
    require_once '../entity/Meal.php';
    require_once '../action/MealAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";
    require_once "../util/TimeUtils.php";
    require_once "../entity/User.php";
    require_once "../provider/testFormat.php";
    require_once "../entity/response/Response.php";

    session_start();
    $arr = $_POST;
    $result = testFavor($arr);
    $myjson = my_json_encode($result);
    echo $myjson;

    function testFavor($arr)
    {
        $date=;
        $userId = $_SESSION['user']->userId;
        $meal = MealAction::getTodayMeal($date);
        $favorite = MealAction::favor($userId, $meal->mealId);
        //var_dump("$favorite");
        if ($favorite === MealAction::$FAVOR_FAIL) {
            $result = new Response(false,"favor failed");
            return $result;
        } elseif ($favorite === MealAction::$FAVOR_NOT_FOUND_MEAL_ID) {
            $result = new Response(false,"can't find this meal");
            return $result;
        } elseif ($favorite === MealAction::$FAVOR_NOT_ORDER_MEAL) {
            $result = new Response(false,"can't find this order");
            return $result;
        } elseif ($favorite === MealAction::$FAVOR_DUPLICATE) {
            $result = new Response(false,"you have favorited this meal");
            return $result;
        } elseif ($favorite === true) {
            $result = new Response(true);
            return $result;
        }
    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午12:54
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
    $result = testCancelFavor($arr);
    $myjson = my_json_encode($result);
    echo $myjson;

    function testCancelFavor($arr)
    {
        $date=TimeUtils::getCurrentDate();
        $userId = $_SESSION['user']->userId;
        $meal = MealAction::getTodayMeal($date);
        $favorite = MealAction::cancelFavor($userId, $meal->mealId);
        if ($favorite === MealAction::$CANCEL_FAVOR_FAIL) {
            $result = new Response(false,"cancel favor failed");
            return $result;
        } elseif ($favorite === MealAction::$CANCEL_FAVOR_NOT_ORDER_MEAL) {
            $result = new Response(false,"you haven't ordered yet");
            return $result;
        } elseif ($favorite === MealAction::$CANCEL_FAVOR_NOT_FAVOR_BEFORE) {
            $result = new Response(false,"you haven't liked it ");
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
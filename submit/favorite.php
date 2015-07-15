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
    require_once "../Util/TimeUtils.php";
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
        $userId = $_SESSION['user']->userId;
        $mealId = $arr["mealId"];
        $favorite = MealAction::favor($userId, $mealId);
        //var_dump("$favorite");
        if ($favorite === -1) {
            $result = new Response(false,"favor failed");
            return $result;
        } elseif ($favorite === -2) {
            $result = new Response(false,"can't find this meal");
            return $result;
        } elseif ($favorite === -3) {
            $result = new Response(false,"can't find this order");
            return $result;
        } elseif ($favorite === -4) {
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
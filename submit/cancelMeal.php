<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 下午11:24
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
    $result = testCancelMeal($arr);
    $myjson = my_json_encode($result);
    echo $myjson;

    function testCancelMeal($arr)
    {

    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
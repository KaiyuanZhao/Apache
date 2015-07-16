<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 下午11:39
 */
    header("Content-Type: text/html; charset=utf-8");
   // require_once '../entity/Meal.php';
    require_once '../action/MealAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";
    require_once "../provider/testFormat.php";
    require_once "../entity/response/mealsRes.php";
    require_once "../entity/Meal.php";
    session_start();
    $result = testGetMeals();
    $myjson = my_json_encode($result);
    echo $myjson;
    function testGetMeals()
    {
        $getmealFlag = MealAction::getMeals();
        if ($getmealFlag === -1) {
            $result = new Response(false,"get meals failed");
            return $result;
        } elseif (isset($getmealFlag)) {
            $result = new mealsRes(true,"",$getmealFlag);
            var_dump($result);
            return $result;
        }
    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
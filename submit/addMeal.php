<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 下午1:40
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
    //testAddMeal();

    function testAddMeal($arr)
    {
        $meal = $arr["mealName"];
       // $meal = "lyn4";
        $testformat = new testFormat();
        //var_dump($meal);
        if ($testformat->testMeal($meal)) {
            $flag = MealAction::addMeal($meal);
            var_dump($flag);
            if ($flag === -2) {
                $result = new Response(false, "the meal had been in the list");
                return $result;
            } elseif ($flag === -1) {
                $result = new Response(false,"add meal fail");
                return $result;
            } elseif (isset($flag)){
                $result = testAddTodayMeal($flag->mealId);
               // var_dump($result);
                return $result;
            }
        }
        else{
                $result = new Response(false,"wrong format");
                return $result;
        }
    }

    function testAddTodayMeal($mealId)
    {
        $addTodayMealFlag = MealAction::addTodayMeal($mealId);
        //var_dump($addTodayMealFlag);
        if ($addTodayMealFlag === -1) {
            $result = new Response(false,"add fail");
            return $result;
        } elseif ($addTodayMealFlag === -2) {
            $result = new Response(false,"can't find the meat");
            return $result;
        } elseif ($addTodayMealFlag === -3) {
            $result = new Response(false,"the food had been added");
            return $result;
        } elseif ($addTodayMealFlag === true) {
            $result = new Response(true);
            return $result;
        }
    }


    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
?>
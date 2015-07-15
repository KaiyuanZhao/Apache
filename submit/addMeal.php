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


    function testAddMeal($arr)
    {
        $meal = $arr["addMeal"];
        $testformat = new testFormat();
        //var_dump($meal);
        if ($testformat->testMeal($meal)) {
            $flag = MealAction::addMeal($meal);
            //var_dump($flag);
            if ($flag === -2) {
                $result = new Response(false, "the meal had been in the list");
                return $result;
            } elseif ($flag == true) {
                $result = new Response(true);
                return $result;
            }
        }
    }


    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
?>
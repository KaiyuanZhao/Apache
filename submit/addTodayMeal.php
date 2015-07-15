<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午12:12
 */
    header("Content-Type: text/html; charset=utf-8");
    require_once '../entity/Meal.php';
    require_once '../action/MealAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";

    $addTodayMealFlag=MealAction::addTodayMeal($meadId=16);
    var_dump($addTodayMealFlag);
    if ($addTodayMealFlag===-1){
        echo "add fail";
    }
    elseif ($addTodayMealFlag===-2){
        echo "can't find the meal";
    }
    elseif ($addTodayMealFlag===-3){
        echo "the food had been added";
    }
    elseif ($addTodayMealFlag===true){
        echo "add success!";
    }


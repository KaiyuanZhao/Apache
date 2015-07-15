<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 下午11:39
 */
    header("Content-Type: text/html; charset=utf-8");
    require_once '../entity/Meal.php';
    require_once '../action/MealAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";
    $getmealFlag=MealAction::getMeals();
    if ($getmealFlag==-1){
        echo "get meals failed";
    }
    elseif (isset($getmealFlag)){
        echo "success";
        var_dump($getmealFlag);
    }

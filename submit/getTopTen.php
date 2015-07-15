<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午12:57
 */
    header("Content-Type: text/html; charset=utf-8");
    require_once '../entity/Meal.php';
    require_once '../action/MealAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";
    require_once "../entity/MealFavor.php";
    $getTopTenFlag=MealAction::getTopTenMeals();
    var_dump($getTopTenFlag);
    if ($getTopTenFlag===-1){
        echo "get meal fail";
    }
    elseif (isset($getTopTenFlag)){
        echo "success!";
    }
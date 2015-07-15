<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/15
 * Time: 上午12:26
 */
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set('PRC');
    require_once '../entity/Meal.php';
    require_once '../action/MealAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";
    $date=date('Y-m-d', time());
    $getTodayMealsFlag=MealAction::getTodayMeals($date);
    if ($getTodayMealsFlag==-1){
        echo "get today meals failed";
    }
    elseif (isset($getTodayMealsFlag)){
        echo "success!";
        var_dump($getTodayMealsFlag);
    }
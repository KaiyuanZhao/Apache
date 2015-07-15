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
    $userId=2;
    $mealId=24;
    $favorite=MealAction::cancelFavor($userId,$mealId);
    var_dump("$favorite");
    if ($favorite===-1){
        echo "cancel favor failed";
    }
    elseif ($favorite===-2){
        echo "you haven't ordered yet";
    }
    elseif ($favorite===-3){
        echo "You haven't favored it";
    }
    elseif ($favorite===true){
        echo "success!";
    }
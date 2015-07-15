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
    require_once "../TimeUtils/TimeUtils.php";
    $userId=2;
    $mealId=24;
    $favorite=MealAction::favor($userId,$mealId);
    var_dump("$favorite");
    if ($favorite===-1){
        echo "favor failed";
    }
    elseif ($favorite===-2){
        echo "can't fine this meal";
    }
    elseif ($favorite===-3){
        echo "can't find this order";
    }
    elseif ($favorite===-4){
        echo "you have favorited this meal";
    }
    elseif ($favorite===true){
        echo "success!";
    }
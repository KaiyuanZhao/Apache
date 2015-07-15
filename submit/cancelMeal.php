<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 下午11:24
 */
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set('PRC');
    require_once '../entity/Meal.php';
    require_once '../action/MealAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";
    require_once "../provider/testFormat.php";
    session_start();
    $meal=$_POST["cancelMeal"];
    $testformat=new testFormat();
    var_dump($meal);
    if ($testformat->testMeal($meal)) {
        $flag=MealAction::addMeal($meal);
        var_dump($flag);
        if ($flag===-2) {
            echo "the meal had been in the list";
        }
        elseif ($flag==true){
            echo "success";
        }
    }
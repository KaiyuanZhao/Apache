<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 下午6:41
 */

    header("Content-Type: text/html; charset=utf-8");
    require_once '../entity/Meal.php';
    require_once '../action/OrderAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";
    require_once "../provider/testFormat.php";
    require_once "../entity/response/Response.php";
    require_once "../entity/response/mealsRes.php";
    require_once "../util/TimeUtils.php";
    require_once "../entity/MealFavor.php";
    require_once "../entity/Order.php";
    require_once "../entity/response/ordersRes.php";
    require_once "../entity/User.php";
    session_start();
    $arr = $_POST;
    $result = testGetOrders();
    $myjson = my_json_encode($result);
    echo $myjson;

    function testGetOrders(){
        $getOrderFlag = OrderAction::getOrders();
        if ($getOrderFlag === OrderAction::$GET_ORDERS_FAIL) {
            $result = new Response(false, "失败！");

            return $result;
        }
        elseif (isset($getOrderFlag)){
            $amount = sizeof($getOrderFlag);
            $result = new ordersRes("true","",$getOrderFlag,$amount);
           // var_dump($result);
            return $result;
        }
    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
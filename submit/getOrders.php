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
require_once "../entity/response/OrdersResponse.php";
require_once "../entity/User.php";
session_start();
$getOrderFlag = OrderAction::getOrders();
if ($getOrderFlag === OrderAction::$GET_ORDERS_FAIL) {
    $result = new Response(false, "数据库连接失败");
    echo json_encode($result);
} elseif (isset($getOrderFlag)) {
    $amount = sizeof($getOrderFlag);
    $orders = array();
    $prevLocation = "----";
    $count = 0;
    $users = array();
    foreach($getOrderFlag as $order)
    {
        if ($order->user->location != $prevLocation)
        {
            if ($prevLocation != "----")
                $orders[] = ["location" => $prevLocation,
                "count" => $count,
                "users" => $users];
            $count = 0;
            $prevLocation = $order->user->location;
            $users = array();
        }
        $users[] = ["username" => $order->user->username,
        "createtime" => $order->createdTime];
        $count++;
    }
    if ($prevLocation != "----")
        $orders[] = ["location" => $prevLocation,
            "count" => $count,
            "users" => $users];
    $result = new OrdersResponse("true", "", $orders, $amount);
    echo json_encode($result);
}
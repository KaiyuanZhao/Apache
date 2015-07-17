<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/16
 * Time: 17:36
 */
header("Content-Type: text/html; charset=utf-8");
require_once "../entity/User.php";
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../action/OrderAction.php";
require_once "../util/TimeUtils.php";

$type = $_POST["type"];
$userId = $_POST["userId"];
if ($type == 0) {
    if (TimeUtils::isTimeAvailable()) {
        $result = OrderAction::orderMeal($userId);
        if ($result === true)
            echo json_encode(['success' => true]);
        else if ($result === OrderAction::$ORDER_MEAL_FAIL)
            echo json_encode(['success' => false, 'errorMessage' => "服务器连接错误"]);
    } else {
        echo json_encode(['success' => false, 'errorMessage' => "还没到点餐时间呢"]);
    }
} else if ($type == 1) {
    $result = OrderAction::cancelOrder($userId);
    if ($result === true)
        echo json_encode(['success' => true]);
    else if ($result === OrderAction::$CANCEL_ORDER_FAIL)
        echo json_encode(['success' => false, 'errorMessage' => "服务器连接错误"]);
    else if ($result === OrderAction::$CANCEL_ORDER_NOT_ORDER_BEFORE)
        echo json_encode(['success' => false, 'errorMessage' => "您没有点餐呢"]);
}
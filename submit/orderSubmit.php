<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 上午10:08
 */
header("Content-Type: text/html; charset=utf-8");
require_once '../entity/User.php';
require_once '../action/OrderAction.php';
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../provider/testFormat.php";
require_once "../entity/response/Response.php";
require_once "../util/TimeUtils.php";

session_start();
$result = testOrderSubmit();
$myjson = json_encode($result);
echo $myjson;

function testOrderSubmit()
{
    $userId = $_SESSION['user']->userId;
    if (TimeUtils::isTimeAvailable()) {
        $orderFlag = OrderAction::orderMeal($userId);
        if ($orderFlag === OrderAction::$ORDER_MEAL_FAIL) {
            $result = new Response(false, "抱歉，订餐失败。");
            return $result;
        } elseif ($orderFlag === true) {
            $result = new Response(true);
            return $result;
        }
    } else {
        $result = new Response(false, "下午三点到五点才是订餐时间呦");
        return $result;
    }
    return new Response(false, "服务器故障");
}
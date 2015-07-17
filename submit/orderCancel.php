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
$result = testOrderCancel();
$myjson = json_encode($result);
echo $myjson;

function testOrderCancel()
{
    $userId = $_SESSION['user']->userId;
    $orderFlag = OrderAction::cancelOrder($userId);
    if ($orderFlag === OrderAction::$CANCEL_ORDER_FAIL) {
        $result = new Response(false, "cancel fail");
        return $result;
    } elseif ($orderFlag === OrderAction::$CANCEL_ORDER_NOT_ORDER_BEFORE) {
        $result = new Response(false, "you have not ordered yet");
        return $result;
    } elseif ($orderFlag === true) {
        $result = new Response(true);
        return $result;
    }
    return new Response(false, "服务器故障");
}
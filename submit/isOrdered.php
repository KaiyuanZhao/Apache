<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 下午1:27
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
$result = testIsOrder();
$myjson = json_encode($result);
echo $myjson;

function testIsOrder()
{
    $userId = $_SESSION['user']->userId;
    $flag = OrderAction::isOrdered($userId);
    if ($flag === OrderAction::$IS_ORDERED_FAIL) {
        $result = new Response(false, "is_order fail");
        return $result;
    } elseif ($flag === true) {
        $result = new Response(false, "the user had ordered");
        return $result;
    } elseif ($flag === false) {
        $result = new Response(true, "can order");
        return $result;
    }
    return new Response(false, "服务器故障");
}
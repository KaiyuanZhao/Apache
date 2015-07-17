<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 下午5:16
 */
header("Content-Type: text/html; charset=utf-8");
require_once "../entity/User.php";
require_once "../action/OrderAction.php";
require_once "../action/MealAction.php";
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../provider/testFormat.php";
require_once "../entity/response/Response.php";
require_once "../util/TimeUtils.php";
session_start();
$result = testIsLiked();
$myjson = json_encode($result);
echo $myjson;

function testIsLiked()
{
    $userId = $_SESSION['user']->userId;
    $flag = MealAction::isFavored($userId);
    if ($flag === MealAction::$IS_FAVORED_FAIL) {
        $result = new Response(false, "点赞失败！");
        return $result;
    } elseif ($flag === MealAction::$IS_FAVORED_NOT_ORDER_MEAL) {
        $result = new Response(false, "你还没有吃！");
        return $result;
    } elseif ($flag === false) {
        $result = new Response(true, "");
        return $result;
    } elseif (isset($flag)) {
        $result = new Response(false, "你已经点过赞了!");
        return $result;
    }
    return new Response(false, "服务器故障");
}
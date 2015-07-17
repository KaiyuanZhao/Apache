<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 下午3:57
 */

header("Content-Type: text/html; charset=utf-8");
require_once "../entity/User.php";
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../action/UserAction.php";
require_once "../provider/testFormat.php";
require_once "../entity/response/Response.php";
require_once "../util/TimeUtils.php";
session_start();
$arr = $_POST;
$result = testChangePwd($arr);
$myjson = json_encode($result);
echo $myjson;

function testChangePwd($arr)
{
    $userId = $_SESSION['user']->userId;
    $previousPassword = $arr['prepassword'];
    $newPassword = $arr['newPassword'];
    $changeFlag = UserAction::changePassword($userId, $previousPassword, $newPassword);
    if ($changeFlag === UserAction::$CHANGE_PASSWORD_FAIL) {
        $result = new Response(false, "更改密码失败！");
        return $result;
    } elseif ($changeFlag === UserAction::$CHANGE_PASSWORD_NO_USER) {
        $result = new Response(false, "没有此用户");
        return $result;
    } elseif ($changeFlag === UserAction::$CHANGE_PASSWORD_PREVIOUS_PASSWORD_WRONG) {
        $result = new Response(false, "密码有错");
        return $result;
    } elseif (isset($changeFlag)) {
        $result = new Response(true);
        return $result;
    }
    return new Response(false, "服务器故障");
}
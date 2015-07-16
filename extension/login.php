<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/16
 * Time: 11:29
 */
header("Content-Type: text/html; charset=utf-8");
require_once "../entity/User.php";
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../action/UserAction.php";
require_once "../provider/testFormat.php";
require_once "response/LoginResponse.php";
session_start();
$arr = $_POST;
$email = $arr["username"];
$password = $arr["password"];
$format = new testFormat();
$result = NULL;
if ($format->testLogin($email, $password)) {
    $user = UserAction::login($email, $password);
    if ($user instanceof User) {
        $_SESSION['user'] = $user;
        $result = new LoginResponse(true, "", $user->userId, $user->username, $user->nickname);
    } else
        $result = new LoginResponse(false, "用户名密码不匹配");
} else
    $result = new LoginResponse(false, "输入格式有误");

echo json_encode($result);
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
require_once "../entity/response/Response.php";
session_start();
$arr = $_POST;
$result = login($arr);
$returnResult = json_encode($result);
echo $returnResult;

function login($arr)
{
    $email = $arr["username"];
    $password = $arr["password"];
    $testformat = new testFormat();
    if ($testformat->testLogin($email, $password)) {
        $user = UserAction::login($email, $password);
        if ($user instanceof User) {
            $_SESSION['user'] = $user;
            return new Response(true, "");
        } else {
            $result = new Response(false, "用户名密码不匹配");
            return $result;
        }
    } else {
        $result = new Response(false, "输入格式有误");
        return $result;
    }
}
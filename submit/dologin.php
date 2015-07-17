<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/13
 * Time: 下午11:03
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
    $result = testLogin($arr);
    $myjson = my_json_encode($result);
    echo $myjson;


function testLogin($arr)
{

    $email = $arr["username"];
    $password = $arr["password"];
    $testformat = new testFormat();
    if ($testformat->testLogin($email, $password)) {
        $user = UserAction::login($email, $password);
        if (!($user === UserAction::$LOGIN_FAIL)) {
            $_SESSION['user'] = $user;
            $result=new Response(true,"");
            return $result;
        } else {
            $result=new Response(false,"错误的账号/密码");
            return $result;
        }
    } else {
        $result=new Response(false,"错误的格式，请按照相应格式输入");
        return $result;
    }
}

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
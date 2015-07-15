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

    $useraction = new UserAction();
    $email = $arr["username"];
    $password = $_POST["password"];
    $testformat = new testFormat();
    if ($testformat->testLogin($email, $password)) {
        $user = $useraction->login($email, $password);
        if ($user != -1) {
            $_SESSION['user'] = $user;
            $result=new Response(true);
            return $result;
            // header("Location: ../index/userc.php");
        } else {
            //   echo "wrong account/password";
            $result=new Response(false,"wrong account/password");
            return $result;
        }
    } else {
        $result=new Response(false,"wrong format");
        return $result;
    }
}
function my_json_encode($phparr)
{
    return json_encode($phparr);
}
?>

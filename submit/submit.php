<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/10
 * Time: 上午10:39
 */
// http_redirect();
//header("Location: userc.php");
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

    
    $useraction=new UserAction();
    var_dump($_POST);
    $checkFormat=true;
    $email=($_POST["email"]);
    $psw=($_POST["psw"]);
    $username=($_POST["username"]);
    $nickname=($_POST["nickname"]);
    $department=($_POST["department"]);
    $location=($_POST["location"]);
    $description=($_POST["description"]);
    //echo  $user->getEmail();

    $testformat=new testFormat();
    if (!$testformat->testReg($email,$psw,$username,$nickname,$department,$location,$description)) {
        $checkFormat = false;
        echo "wrong format";
    }
//一系列表格验证！暂略
// echo  $username=$_POST["username"

    if ($checkFormat) {
        $user = $useraction->register($email, $psw, $username, $nickname, $department, $location, $description，$icon="");
        if ($user == -1)
            echo "register fail";
        elseif ($user == -2)
            echo "email has been registered";
        elseif (isset($user)) {
            $_SESSION['user'] = $user;
            header("Location: ../index/userc.php");
        }
    }


?>
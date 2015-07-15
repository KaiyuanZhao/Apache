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
    $arr = $_POST;
    $result = testLogin($arr);
    $myjson = my_json_encode($result);
    echo $myjson;
    session_start();

    function testLogin($arr)
    {

        $useraction = new UserAction();
        $email = $arr["email"];
        $password = $_POST["password"];
        $testformat = new testFormat();
        if ($testformat->testLogin($email, $password)) {
            $user = $useraction->login($email, $password);
            if ($user != -1) {
                $_SESSION['user'] = $user;
                $rusult[0]=1;
                $result[1]="success!";
                return true;
               // header("Location: ../index/userc.php");
            } else {
                echo "wrong account/password";
                return false;
            }
        } else {
                echo "wrong format";
        }
    }
    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
?>

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
    $result = testReg($arr);
    $myjson = my_json_encode($result);
    echo $myjson;


  //  var_dump($_POST);
    function testReg($arr)
    {
        $checkFormat = true;
        $email = ($_POST["email"]);
        $psw = ($_POST["psw"]);
        $username = ($_POST["username"]);
        $nickname = ($_POST["nickname"]);
        $department = ($_POST["department"]);
        $location = ($_POST["location"]);
        $description = ($_POST["description"]);
        $icon = "ss";
        //echo  $user->getEmail();

        $testformat = new testFormat();
        if (!$testformat->testReg($email, $psw, $username, $nickname, $department, $location, $description)) {
            $checkFormat = false;
           // echo "wrong format";
            $result=new Response(false,"wrong format");
            return $result;
        }

// echo  $username=$_POST["username"

        if ($checkFormat) {
            $user = UserAction::register($email, $psw, $username, $nickname, $department, $location, $description, $icon);
            if ($user === -1){
                $result=new Response(false,"register fail");
            }
            elseif ($user === -2){
                $result=new Response(false,"email has been registerd");
                return $result;
            }
            elseif (isset($user)) {
                $_SESSION['user'] = $user;
                $result=new Response(true);
                return $result;
            }
        }
    }

function my_json_encode($phparr)
{
    return json_encode($phparr);
}
?>
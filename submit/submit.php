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
    date_default_timezone_set("PRC");
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
        $email = ($arr["email"]);
        $psw = ($arr["password"]);
        $username = ($arr["username"]);
        $nickname = "nickname";
        //$nickname = ($_POST["nickname"]);
        //$department = ($_POST["department"]);
        $department = "百姓网";
        $location = ($arr["location"]);
        $description = ($arr["taste"]);
        $fname = $_FILES['savator']["name"];
        $cache_path = "icon/";
        $uniqStr = uniqid(strtotime("now") . "_" . mt_rand(100000, 999999) . "_");
        $suffix = strtolower(stristr($fname, "."));
        $fname_new = $cache_path . $uniqStr . $suffix;
 //     $upFilePath = "icon/".$_FILES['savator']['name'];
        if (($suffix != ".png") and ($suffix != ".jpg") and ($suffix != ".jpeg") and ($suffix != ".gif")) {
            $result = new Response(false, "wrong file type");
            return $result;
        }
        $ok = move_uploaded_file($_FILES['savator']['tmp_name'], $fname_new);
        //echo json_encode($upFilePath);
        if ($ok === FALSE) {
            //$flag="fail";
            //echo json_encode($suffix);
            $result = new Response(false, "upload fail");
            return $result;
        } else {
            $icon = $fname_new;
            //echo  $user->getEmail();
            $testformat = new testFormat();
            if (!$testformat->testReg($email, $psw, $username, $nickname, $department, $location, $description)) {
                $checkFormat = false;
                // echo "wrong format";
                $result = new Response(false, "wrong format");
                return $result;
            }

// echo  $username=$_POST["username"

            if ($checkFormat) {
                $user = UserAction::register($email, $psw, $username, $nickname, $department, $location, $description, $icon);
                if ($user === -1) {
                    $result = new Response(false, "register fail");
                } elseif ($user === -2) {
                    $result = new Response(false, "email has been registerd");
                    return $result;
                } elseif (isset($user)) {
                    $_SESSION['user'] = $user;
                    $result = new Response(true);
                    return $result;
                }
            }
        }
    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }

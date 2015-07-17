<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/10
 * Time: 上午10:39
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
$result = testReg($arr);
$myjson = json_encode($result);
echo $myjson;

function testReg($arr)
{
    $checkFormat = true;
    $email = ($arr["email"]);
    $psw = ($arr["password"]);
    $username = ($arr["username"]);
    $nickname = "nickname";
    $department = "百姓网";
    //$nickname = ($_POST["nickname"]);
    //$department = ($_POST["department"]);
    $location = ($arr["location"]);
    $description = ($arr["taste"]);

    $testformat = new testFormat();
    if (!$testformat->testReg($email, $psw, $username, $nickname, $department, $location, $description)) {
        $result = new Response(false, "格式错误，请按照一定的格式输入！");
        return $result;
    }

    $fname = $_FILES['savator']["name"];
    $cache_path = "icon/";
    $uniqStr = uniqid(strtotime("now") . "_" . mt_rand(100000, 999999) . "_");
    $suffix = strtolower(stristr($fname, "."));
    $fname_new = $cache_path . $uniqStr . $suffix;
    //     $upFilePath = "icon/".$_FILES['savator']['name'];
    if (($suffix != '') and ($suffix != null)) {
        if (($suffix != ".png") and ($suffix != ".jpg") and ($suffix != ".jpeg") and ($suffix != ".gif")) {
            $result = new Response(false, "wrong file type");
            return $result;
        }
        $ok = move_uploaded_file($_FILES['savator']['tmp_name'], $fname_new);
        if ($ok === FALSE) {
            $result = new Response(false, "upload fail");
            return $result;
        } else {
            $icon = $fname_new;
            if ($checkFormat) {
                $user = UserAction::register($email, $psw, $username, $nickname, $department, $location, $description, $icon);
                if ($user === UserAction::$REGISTER_FAIL) {
                    $result = new Response(false, "注册失败！");
                    return $result;
                } elseif ($user === UserAction::$REGISTER_EMAIL_DUPLICATE) {
                    $result = new Response(false, "该邮箱已被注册！");
                    return $result;
                } elseif (isset($user)) {
                    $_SESSION['user'] = $user;
                    $result = new Response(true);
                    return $result;
                }
            }
        }
    } elseif ($checkFormat) {
        $icon = "";
        $user = UserAction::register($email, $psw, $username, $nickname, $department, $location, $description, $icon);
        if ($user === UserAction::$REGISTER_FAIL) {
            $result = new Response(false, "注册失败！");
            return $result;
        } elseif ($user === UserAction::$REGISTER_EMAIL_DUPLICATE) {
            $result = new Response(false, "该邮箱已被注册！");
            return $result;
        } elseif (isset($user)) {
            $_SESSION['user'] = $user;
            $result = new Response(true);
            return $result;
        }
    }
    return new Response(false, "服务器故障");
}
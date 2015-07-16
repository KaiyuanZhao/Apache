<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 下午2:49
 */
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
    $result = testEdit($arr);
    $myjson = my_json_encode($result);
    echo $myjson;

    function testEdit($arr)
    {
        $userId = $_SESSION['user']->userId;
        $username = $_SESSION['user']->username;
        $nickname = $_SESSION['user']->nickname;
        $department = $_SESSION['user']->department;
        $location = $_SESSION['user']->location;
        $description = $_SESSION['user']->description;
        if (($arr["location"] != null) and ($arr["location"] != '')) {
            $location = $arr["location"];
        }
        if (($arr["location"] != null) and ($arr["location"] != '')) {
        }

        $fname = $_FILES['savator']["name"];
        $cache_path = "icon/";
        $uniqStr = uniqid(strtotime("now") . "_" . mt_rand(100000, 999999) . "_");
        $suffix = strtolower(stristr($fname, "."));
        $fname_new = $cache_path . $uniqStr . $suffix;
        if (($suffix != '') and ($suffix != null)) {
            if (($suffix != ".png") and ($suffix != ".jpg") and ($suffix != ".jpeg") and ($suffix != ".gif")) {
                $result = new Response(false, "错误的图片格式");
                return $result;
            }
            $ok = move_uploaded_file($_FILES['savator']['tmp_name'], $fname_new);
            //echo json_encode($upFilePath);
            if ($ok === FALSE) {
                //$flag="fail";
                //echo json_encode($suffix);
                $result = new Response(false, "上传失败！");
                return $result;
            } else {
                $icon = $fname_new;
                $user = UserAction::modify($userId, $username, $nickname, $department, $location, $description, $icon);
                if ($user === UserAction::$MODIFY_FAIL) {
                    $result = new Response(false, "更新数据失败！");
                    return $result;
                } elseif ($user === UserAction::$MODIFY_NO_USER) {
                    $result = new Response(false, "没有此用户！");
                    return $result;
                } elseif ($user === UserAction::$MODIFY_NO_CHANGE) {
                    $result = new Response(false, "没有任何改变！");
                    return $result;
                } elseif (isset($user)) {
                    //$_SESSION['user'] = $user;
                    $result = new Response(true);
                    return $result;
                }
            }
        } else {
            $icon = "";
            $user = UserAction::modify($userId, $username, $nickname, $department, $location, $description, $icon);
            if ($user === UserAction::$MODIFY_FAIL) {
                $result = new Response(false, "更新数据失败！");
                return $result;
            } elseif ($user === UserAction::$MODIFY_NO_USER) {
                $result = new Response(false, "没有此用户！");
                return $result;
            } elseif ($user === UserAction::$MODIFY_NO_CHANGE) {
                $result = new Response(false, "没有任何改变！");
                return $result;
            } elseif (isset($user)) {
                //$_SESSION['user'] = $user;
                $result = new Response(true);
                return $result;
            }


        }
    }
    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
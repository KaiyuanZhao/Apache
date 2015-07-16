<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/16
 * Time: 下午5:16
 */
    header("Content-Type: text/html; charset=utf-8");
    require_once '../entity/User.php';
    require_once '../action/OrderAction.php';
    require_once "../config.php";
    require_once "../provider/Database.php";
    require_once "../provider/testFormat.php";
    require_once "../entity/response/Response.php";
    require_once "../util/TimeUtils.php";
    session_start();
    $result = testIsOrder();
    $myjson = my_json_encode($result);
    echo $myjson;

    function testIsLiked(){
        $userId=$_SESSION['user']->userId;
        $flag = MealAction::isLiked($userId);
        if ($flag === OrderAction::$IS_LIKED_FAIL){
            $result = new Response(false,"点赞失败！");
            return $result;
        }
        elseif ($flag===true){
            $result = new Response(false, "不能重复点赞！");
            return $result;
        }
        elseif ($flag===false){
            $result = new Response(true,"");
            return $result;
        }
    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
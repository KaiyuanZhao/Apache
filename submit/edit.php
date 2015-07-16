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

    function testEdit($arr){

    }

    function my_json_encode($phparr)
    {
        return json_encode($phparr);
    }
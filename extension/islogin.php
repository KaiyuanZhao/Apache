<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/16
 * Time: 16:04
 */
require_once "../entity/User.php";

session_start();
$result = NULL;
if (isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
    $result = new LoginResponse(true, "", $user->userId, $user->username, $user->nickname);
} else {
    $result = new LoginResponse(false);
}

echo json_encode($result);


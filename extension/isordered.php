<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/16
 * Time: 13:26
 */
header("Content-Type: text/html; charset=utf-8");
require_once "../entity/User.php";
require_once "../config.php";
require_once "../provider/Database.php";
require_once "../action/OrderAction.php";
require_once "../util/TimeUtils.php";


$userId = $_POST["userId"];
$result = OrderAction::isOrdered($userId);
echo json_encode(['success' => $result]);
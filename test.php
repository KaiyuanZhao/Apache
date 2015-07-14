<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/14
 * Time: 9:45
 */


require_once "entity/User.php";
require_once "config.php";
require_once "provider/Database.php";
require_once "action/UserAction.php";

$result = UserAction::login("123@baixing.com", "456789");
var_dump($result);
$result = UserAction::register("123@baixing.com", "456789", "test", "nickname", "depart", "1023", "");
var_dump($result);
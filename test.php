<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/14
 * Time: 9:45
 */
header('content-type:text/html;charset=utf-8');
//require_once "entity/User.php";
//require_once "config.php";
//require_once "provider/Database.php";
//require_once "action/UserAction.php";
//
//$result = UserAction::login("123@baixing.com", "456789");
//var_dump($result);
//$result = UserAction::register("1234@baixing.com", "456789", "test", "nickname", "depart", "1023", "", "");
//var_dump($result);
//$result = UserAction::login("123@baixing.com", "456789");
//var_dump($result);
//$result = UserAction::modify(1, "test2", "nickname", "depart2", "1830", "desc", "icon");
//var_dump($result);
//$result = UserAction::changePassword(1, "123456", "456789");
//var_dump($result);
//$result = UserAction::changePassword(1, "456789", "123456");
//var_dump($result);
//$result = UserAction::changePassword(1, "123456", "456789");
//var_dump($result);
//
//$test = array(1);
//var_dump($test);
//$test[] = 2;
//var_dump($test);
//
//require_once "entity/Meal.php";
//require_once "action/MealAction.php";
//
//$result = MealAction::addMeal("糖醋里脊");
//var_dump($result);
//$result = MealAction::getMeals();
//var_dump($result);
//
//$result = MealAction::addMeal("红烧鲤鱼");
//var_dump($result);
//$result = MealAction::getMeals();
//var_dump($result);
//require_once "util/TimeUtils.php";
//$result = TimeUtils::getCurrentDate();
//var_dump($result);
//$result = TimeUtils::getCurrentTime();
//var_dump($result);
//$result = TimeUtils::isTimeAvailable();
//var_dump($result);
//require_once "config.php";
//require_once "provider/Database.php";
//require_once "util/TimeUtils.php";
//require_once "entity/Meal.php";
//require_once "action/MealAction.php";
//$result = MealAction::addTodayMeal(7);
//var_dump($result);
//$result = MealAction::getTodayMeals(TimeUtils::getCurrentDate());
//var_dump($result);
//$result = MealAction::addTodayMeal(8);
//var_dump($result);
//$result = MealAction::getTodayMeals(TimeUtils::getCurrentDate());
//var_dump($result);
//require_once "entity/MealFavor.php";
//$result = MealAction::favor(1, 8);
//var_dump($result);
//$result = MealAction::getTopTenMeals();
//var_dump($result);
//$result = MealAction::cancelFavor(1, 8);
//var_dump($result);
//$result = MealAction::getTopTenMeals();
//var_dump($result);

require_once "config.php";
require_once "entity/User.php";
require_once "entity/Order.php";
require_once "action/OrderAction.php";
require_once "provider/Database.php";
require_once "util/TimeUtils.php";

$result = OrderAction::orderMeal(1);
var_dump($result);
$result = OrderAction::isOrdered(1);
var_dump($result);
$result = OrderAction::isOrdered(5);
var_dump($result);
//$result = OrderAction::orderMeal(1);
//var_dump($result);
$result = OrderAction::getOrders();
var_dump($result);
//$result = OrderAction::cancelOrder(1);
//var_dump($result);
//$result = OrderAction::cancelOrder(1);
//var_dump($result);
//$result = OrderAction::getOrders();
//var_dump($result);


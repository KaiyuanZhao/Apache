<?php
/**
 * Created by PhpStorm.
 * User: lyn
 * Date: 15/7/14
 * Time: 上午10:08
 */
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set('PRC');
    require_once '../entity/User.php';
    require_once '../action/OrderAction.php';
    session_start();
    $date=date('Y-m-d', time());
    //data('Y-m-d',time());
    $userId=$_SESSION['user']->userId;
//  echo  $userId;
    $orderFlag=OrderAction::cancelMeal($userId);
    if ($orderFlag===-1){
        echo "cancel fail";
    }
    elseif ($orderFlag===-2){
        echo "you dong't order yet";
    }
    elseif ($orderFlag===true){
        echo "$userId, success";
    }
?>
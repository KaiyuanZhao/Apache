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
  //  echo  $userId;
      $orderFlag=OrderAction::orderMeal($userId);
      if ($orderFlag===-1){
          echo "sorry,order failed";
      }
      elseif ($orderFlag===true){
          echo "$userId, success ";
      }
?>
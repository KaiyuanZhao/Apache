<?php
//	echo $_POST["username"];
//	echo $_POST["password"];
    session_start();
    require_once "entity/User.php";
	echo "success!";
    echo $_SESSION['user']->userId;
?>
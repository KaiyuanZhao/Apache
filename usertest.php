<?php
require_once "entity/User.php";
session_start();

$_SESSION["user"];
if(isset($_SESSION["user"])){
    echo "done!";
}
?>

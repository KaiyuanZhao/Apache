<?php
require_once "entity/User.php";
session_start();
if(isset($_SESSION["user"])){
    echo $_SESSION["user"]->email;
}
?>

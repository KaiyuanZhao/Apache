<?php
require_once "entity/User.php";
$_SESSION["user"];
if(isset($_SESSION["user"])){
    echo "done!";
}
?>

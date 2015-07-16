<?php
require_once "entity/User.php";
session_start();
<<<<<<< HEAD

$_SESSION["user"];
=======
>>>>>>> 363e489624ce8ac3c660cc79da682ebdd1d0551a
if(isset($_SESSION["user"])){
    echo $_SESSION["user"]->email;
}
?>

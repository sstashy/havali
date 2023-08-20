<?php
session_start();
if($_SESSION["key"]){
    unset($_SESSION["key"]);
    header("Location:../index.php");

}else{    header("Location:../index.php");

}
?>
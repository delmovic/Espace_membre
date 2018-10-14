<?php session_start();
include_once('include/fonction.php');

setcookie("username","",time()-3600);
setcookie("password","",time()-3600);
$_SESSION=array();
session_destroy();
header("location:message.php");


?>


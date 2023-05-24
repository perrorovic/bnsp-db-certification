<?php 
session_start();
$_SESSION=[];
session_destroy();
session_unset();

header("location: index.php");
exit;
?>
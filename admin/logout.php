<?php
session_start();
$_SESSION['alogin']=="";
session_unset();
header("location:index.php");
?>

<?php
session_start();

$_SESSION["logged_in"] = 0;

header("Location: ../login.php");

?>
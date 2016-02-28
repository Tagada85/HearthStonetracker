<?php

session_destroy();
session_start();
$_SESSION["username"] = NULL;
$_SESSION["loggedIn"] = FALSE;
header("location:index.php");

?>
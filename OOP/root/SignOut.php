<?php
session_start();

// session_destroy();


session_destroy();
/*
unset($_SESSION["sid"]);

session_unset();
*/
header("Location: sign_up_in.php");
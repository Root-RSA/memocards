<?php
//Start a session
session_start();
//Define the base path for the routing
define("BASE", "/memocards/");
// Require the autoloader
require_once 'System/autoload.php';
// Launch the app
System\App::run();

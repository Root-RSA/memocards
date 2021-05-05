<?php
//Start a session
session_start();
//Set the garbage collector maxlifetime
define("BASE", "/current_version_of_projects/FlashCards/MVC/");
// Require the autoloader
require_once 'System/autoload.php';
// Launch the app
System\App::run();
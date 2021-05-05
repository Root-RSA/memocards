<?php
// Start the session
session_start();

require_once('../Classes/Autoloader.php');

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = Classes\Conn::getInstance();

    $signIner = new Classes\SignIner($conn);

    if ($signIner->check($username, $password)){
        header("Location: PersonalPage.php");
    } else {
        $_SESSION['message'] = "The username or password are not correct";
        header("Location: sign_up_in.php");
    }

    $_SESSION['username'] = $username;
}
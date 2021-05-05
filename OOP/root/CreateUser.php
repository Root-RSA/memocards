<?php
// Start the session
session_start();

require_once('../Classes/Autoloader.php');

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
    $rawPassword = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
    $password = password_hash($rawPassword, PASSWORD_DEFAULT);


    $conn = Classes\Conn::getInstance();

    $userCreator = new Classes\UserCreator($conn);

    if (!($userCreator->check($username))){
        $userCreator->insert($username, $password);
        header("Location: PersonalPage.php");
    } else {
        $_SESSION['message'] = "The username already exists";
        header("Location: sign_up_in.php");
    }

    $_SESSION['username'] = $username;
}





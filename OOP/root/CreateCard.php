<?php
session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
} else {
    session_destroy();
    header("Location: sign_up_in.php");
}

$topic = htmlspecialchars($_POST['topic']);
$content = htmlspecialchars($_POST['content']);



require_once('../Classes/Autoloader.php');

$conn = Classes\Conn::getInstance();

$newcard = new Classes\CardMaker($conn);

$newcard->insert($username,$topic,$content);



header("Location: PersonalPage.php");


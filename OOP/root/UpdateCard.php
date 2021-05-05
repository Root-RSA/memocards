<?php
session_start();

$topic = $_POST['topic'];
$content = $_POST['content'];
$id = $_SESSION['id'];

require_once('../Classes/Autoloader.php');

$conn = Classes\Conn::getInstance();

$cardUpdater = new Classes\CardUpdater($conn);

$cardUpdater->update($topic,$content, $id);

header("Location: PersonalPage.php");
<?php
session_start();

$id = $_SESSION['id'];

require_once('../Classes/Autoloader.php');

$conn = Classes\Conn::getInstance();

$cardDeleter = new Classes\CardDeleter($conn);

$cardDeleter->delete($id);

header("Location: PersonalPage.php");
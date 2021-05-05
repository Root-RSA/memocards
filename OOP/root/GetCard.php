<?php
session_start();

$topic = htmlentities($_GET['q'], ENT_QUOTES, 'UTF-8');
echo "<pre>";
echo $_SESSION[$topic];
echo "</pre>";
/*
require_once('../Classes/Autoloader.php');

$conn = Classes\Conn::getInstance();

$cardGetter = new Classes\CardGetter($conn);

$cardContent = $cardGetter->getCard($topic);
//echo "<pre>";
echo htmlspecialchars($cardContent);
//echo "</pre>";
$_SESSION['id'] = $cardGetter->getId();
//Testing
//echo $_SESSION['id'];
//echo $topic;



//echo "<pre>";
//print_r($cardContent);
//echo "</pre>";

*/



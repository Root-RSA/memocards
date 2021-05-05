<?php
session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
} else {
    session_destroy();
    header("Location: sign_up_in.php");
}

$searchedText = $_GET['search'];

require_once('../Classes/Autoloader.php');

$conn = Classes\Conn::getInstance();

$searcher = new Classes\Searcher($conn);

$resultList = $searcher->search($username, $searchedText);

$i = 0;

foreach ($resultList as $val){
    $result = preg_match("/([\.] [A-Z]){0}[Α-Ζα-ζА-Яа-яA-Za-z0-9,)(' ]+{$searchedText}[Α-Ζα-ζА-Яа-яA-Za-z0-9,)(' ]+\./u", $val[1], $match[]);
    if($result){
        $resultList[$i][0] = $val[0];
        $resultList[$i][1] = str_replace($searchedText, "<strong>$searchedText</strong>", $match[$i][0]);
    }
    $i++;
}




<?php
session_start();
$message = '';
if (isset($_SESSION['message'])){
    $message = $_SESSION['message'];
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Cards for self-education</title>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="../js/GetCard.js"></script>
    <style>
        body, html {
            height: 100%;
            display: grid;
        }

        .center-me {
            margin: auto;
        }
    </style>
</head>
<body>
<div class="center-me">
    <form action="CreateUser.php" method="post">
        <input type="text" name="username" placeholder="username" size="20" required>
        <input type="text" name="password" placeholder="password" size="20" required>
        <button type="submit" formaction="CreateUser.php">Sign up</button>
        <button type="submit" formaction="SignIn.php">Sign in</button>
    </form>
    <p><?= $message; ?></p>
</div>
</body>
<?php
session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
} else {
    session_destroy();
    header("Location: SignUpIn.php");
}

require_once('../Classes/Autoloader.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Cards for self-education</title>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="../js/GetCard.js"></script>
    <script type="text/javascript" src="../js/EditCardShow.js"></script>
    <style>
        .my-container {
            padding: 20px 20px 20px 20px;
        }

        .card {
            border: 1px solid black;
            background-color: #f2f1eb;
            margin-left: 15px;
        }

        .my-col {
            border: 1px solid black;

        }

        .scroll::-webkit-scrollbar {
            display: none;
            overflow: -moz-scrollbars-none;
        }

        .scroll {
            height: 580px;
            overflow-x: hidden;
            overflow-x: auto;
            -ms-overflow-style: none;
        }

        pre {
            margin: 1em 0;
            font-family: Arial, Helvetica, sans-serif;
            white-space: -moz-pre-wrap; /* Mozilla, supported since 1999 */
            white-space: -pre-wrap; /* Opera */
            white-space: -o-pre-wrap; /* Opera */
            white-space: pre-wrap; /* CSS3 - Text module (Candidate Recommendation) http://www.w3.org/TR/css3-text/#white-space */
            word-wrap: break-word; /* IE 5.5+ */
        }
    </style>
</head>
<body>

<div class="container-1 my-container">
    <div class="row">
        <div class="col">
            <a href="CardFormPage.php"><button>Create card</button></a>
            <div class="row">
                <div class="col">
                    <br><h3>Check out your cards</h3>
                </div>
            </div>
        </div>
        <div class="col">
            <form action="/current_version_of_projects/FlashCards/MVC/Cards/search" style="display: inline-block">
                <input type="text" name="search" required>
                <button type="submit">Search</button>
            </form>
            <a href="SignOut.php" style="float: right;"><button>Sign out</button></a><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col scroll">
            <?php

            $conn = Classes\Conn::getInstance();

            $cardListDisplayer = new Classes\CardListDisplayer($conn);

            $list = $cardListDisplayer->findList($username);

            if($list){
                $list = $cardListDisplayer->getCardList();
                foreach ($list as $val){
                    $cardList[] = $val[0];
                    $_SESSION[$val[0]] = $val[1];
                }
            } else {
                $message = 'You haven\'t created any card yet';
            }

            if(isset($cardList)): foreach ($cardList as $val):

                ?>
                <ul>
                    <li style="cursor: pointer;"><b onclick='getCard(this.innerHTML)'><?= $val; ?></b></li>
                </ul>
            <?php endforeach; else: ?>
                <p><?= 'You haven\'t created any card yet'; ?></p>
            <?php endif; ?>
        </div><br>

        <div class="col">
            <div class="row" id="card" style="display: none;">
                <div class="col">
                    <div class="row">
                        <div class="col card">
<pre>
<strong>Topic:</strong> <span id="topic"></span>

<strong>Card:</strong> <span id="content"></span>
</pre>
                        </div>
                        <div class="col-2">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col" style="margin-left: 15px; padding: 0">
                            <button onclick='editCardShow()'>Edit card</button>
                            <a href="DeleteCard.php" style="float: right;"><button type="submit">Delete card</button></a>
                        </div>
                        <div class="col-2">
                        </div>
                    </div><br>
                </div>
            </div>
            <div class="row" id="editForm" style="display: none;">
                <div class="col">
                    <form action="UpdateCard.php" method="post">
                        <label for="topic">Topic:</label>
                        <input type="text" name="topic" id="topicEdit" placeholder="Keep it short" size="20" required><br><br>

                        <label for="content">Content:</label><br>
                        <textarea type="text" name="content" id="textareaEdit" placeholder="Type your card's content" cols="60" rows="8" required></textarea><br>

                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
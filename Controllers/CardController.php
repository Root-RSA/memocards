<?php

namespace Controllers;

use System\Security;
use System\Conn;
use Models\CardModel;
use System\View;


class CardController
{
    public function actionCreate()
    {
        Security::is_authorized();

        //Create a model
        $cardModel = new CardModel();

        //Sanitizing the user input except 'content', because it's already sanitized by TinyMCE
        $new_domain = htmlentities($_POST['new_domain'], ENT_QUOTES, 'UTF-8');
        $title = htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8');
        $content = $_POST['content'];

        //Check if an existing domain has been selected or a new one created
        $domain = !empty($new_domain) ? $new_domain : $_POST['selected_domain'];

        //Check if a domain hasn't been specified assign it to uncategorized
        $domain = ($domain === "") ? "Uncategorized" : $domain;

        $check = $cardModel->cardExists($title);

        if($check) {
            $msg = "A card with the same name already exists. Please change the name";
            setcookie('feedback', $msg, time()+60, '/', false, false, true);
            header('location: ../views/create');
        } else {
            //Create a card
            $created = $cardModel->actionCreate($_COOKIE['userid'], $title, $content, $domain);

            //Check if it has been created
            $created ? header('location: ../views/allCards') : die("The card hasn't been created");
        }
    }

    public function actionRead()
    {
        //Create a model
        $cardModel = new CardModel();

        //clean the query string
        $str = trim($_GET['search']);

        $card = $cardModel->actionRead($str);

        $_SESSION['card_id'] = $card['id'];

        echo $card['text'];
    }

    public function actionDelete()
    {
        Security::is_authorized();

        //Create a model
        $cardModel = new CardModel();

        //Delete and assign the result to a variable
        $deleted = $cardModel->actionDelete($_SESSION['card_id']);

        //Check if deleted
        $deleted ? header('location: ../views/allCards') : die("The card hasn't bee deleted");
    }

    public function actionUpdate()
    {
        Security::is_authorized();

        //Create a model
        $cardModel = new CardModel();

        //Sanitizing the user input except 'content', because it's already sanitized by TineMCE
        $new_domain = htmlentities($_POST['new_domain'], ENT_QUOTES, 'UTF-8');
        $title = htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8');
        $content = $_POST['content'];

        //Check if an existing domain has been selected or a new one created
        $domain = !empty($new_domain) ? $new_domain : $_POST['selected_domain'];

        $check = $cardModel->cardExists($title);

        if($check && ($check['title'] !== $_SESSION['title'])) {
            $msg = "A card with the same name already exists. Please change the name";
            setcookie('feedback', $msg, time()+60, '/', false, false, true);
            header('location: ../views/update');
        } else {
            //Update and assign the result to a variable
            $updated = $cardModel->actionUpdate($_SESSION['card_id'], $title, $content, $domain);
            //Check if updated
            $updated ? header('location: ../views/allCards') : die("The card hasn't bee updated");
        }
    }
}
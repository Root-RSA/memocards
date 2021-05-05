<?php

namespace Controllers;

use System\View;
use System\Security;
use System\Conn;
use Models\CardModel;
use Models\CardsModel;

class ViewsController
{
    public function actionCreate()
    {
        //session check
        Security::is_authorized();
        $msg = Security::checkFeedback();

        //Create a model
        $cards = new CardsModel();

        $userid = $_COOKIE['userid'];

        //Fetch all domains of the current user
        $domains = $cards->actionListDomains($userid);

        $visibility = (!isset($domains)) ? "none" : "block";

        View::render('create', [
            'create_card' => 'none',
            'allcards' => 'inline',
            'domains' => $domains,
            'visibility' => $visibility,
            'msg' => $msg
        ]);
    }

    public function actionUpdate()
    {
        Security::is_authorized();
        $msg = Security::checkFeedback();

        $cardModel = new CardModel();
        $cardsModel = new CardsModel();

        $card = $cardModel->actionRead($_SESSION['card_id']);
        
        //We put the title here in order to use it for a check later in CardController->actionUpdate
        $_SESSION['title'] = $card['title'];

        if(isset($card)) {
            $domains = $cardsModel->actionListDomains($card['user_id']);
            View::render('update', [
                'card' => $card,
                'domains' => $domains,
                'current_domain' => $card['domain'],
                'msg' => $msg
            ]);
        } else {
            header('location: ../views/allCards');
        }
    }

    public function actionAllcards()
    {
        //session check
        Security::is_authorized();

        //Create a model
        $cards = new CardsModel();

        //Retrieve data by using the model
        $list = $cards->displayAll($_COOKIE['userid']);

        //Fetch all domains of the current user
        $domains = $cards->actionListDomains($_COOKIE['userid']);

        //Add the category "All domains"
        $domains[] = "All domains";

        //Check if the user has already domains
        if(isset($domains)) {
            View::render('cards', [
                'list' => $list,
                'create_card' => 'inline',
                'allcards' => 'none',
                'domains' => $domains,
                'dropdown' => true
            ]);
        } else {
            View::render('cards', [
                'list' => $list,
                'create_card' => 'inline',
                'allcards' => 'none',
                'domains' => $domains,
                'dropdown' => false
            ]);
        }
    }

    public function actionLogin()
    {
        $msg = Security::checkFeedback();
        View::render('login', ['msg' => $msg]);
    }

    public function actionRegister()
    {
        $msg = Security::checkFeedback();
        View::render('registration', ['msg' => $msg]);
    }

    public function actionNotFound()
    {
        View::render('404');
    }

    public function actionIndex()
    {
        View::render('index');
    }
}
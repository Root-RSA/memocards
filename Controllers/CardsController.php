<?php

namespace Controllers;

use System\View;
use System\Conn;
use System\Security;
use Models\CardsModel;

class CardsController
{
//    public function __construct()
//    {
//        return $this;
//    }

    public function actionSearch()
    {
        //session check
        Security::is_authorized();

        if(isset($_GET['search'])) {
            $raw_needle = htmlentities($_GET['search'], ENT_QUOTES, 'UTF-8');
        } else {
            header("location: ../views/allCards");
        }

        //Create a model
        $cards = new CardsModel();

        $userid = $_COOKIE['userid'];

        $found = $cards->search($raw_needle, $userid);

        $needle = preg_quote($raw_needle, '/');

        if ($found) {

            $i = 0;

            foreach ($found as $card) {


                //Change with regex cards' content to excerpt
                preg_match("/([\.\?\!\;] ){0}[^\.\?\!]+($needle)[^\.\?\!]+([\.\?\!\;]|\z)/ui", $card['content'], $match);
//              preg_match("/([\.\?\!\;] ){0}[a-z0-9,)('\-#\"—\|\$\%\>\<_=\/ ]+{$needle}[a-z0-9,)('\-\+#\"—\|$\%\>\<_=\/ ]+[\.\?\!\;]/ui", $card['content'], $match);

                //Check if the regex matched anything
                $match[0] = isset($match[0]) ? $match[0]: "Excerpt for this card is not available";

                //Mark as bold the searched text
                $found[$i]['excerpt'] = str_ireplace($_GET['search'], "<strong>$raw_needle</strong>", $match[0]);
                $i++;
            }

            $message = "";
        } else {
            $message = "Nothing has been found";
        }

        View::render('results', ['found' => $found, 'searched' => $raw_needle, 'message' => $message]);
    }

    public function actionDisplayByDomain()
    {
        //session check
        Security::is_authorized();

        //If there is some error with AJAX it will just show the page with all cards
        if(isset($_GET['domain'])) {
            $domain = htmlentities($_GET['domain'], ENT_QUOTES, 'UTF-8');
        } else {
            header('location: ../views/allCards');
        }

        //Create a model
        $cards = new CardsModel();

        $userid = $_COOKIE['userid'];

        $cards->actionFindByDomain($domain, $userid);
    }


//    public function actionUpdateField()
//    {
//        //Crete a connection
//        $conn = Conn::getInstance();
//
//        $old = "";
//        $new = "Computer science";
//
//        // The insert query.
//        $sql = "UPDATE general SET domain = :new WHERE domain = :old";
//        // Bind and filter.
//        $query = $conn->get()->prepare($sql);
//        $query->bindParam(':old', $old, \PDO::PARAM_STR);
//        $query->bindParam(':new', $new, \PDO::PARAM_STR);
//        $query->execute();
//    }
}
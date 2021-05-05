<?php

namespace Models;

use System\Conn;

class CardsModel
{
    public function displayAll($userid)
    {
        //Crete a connection
        $conn = Conn::getInstance();

        // The retrieve query.
        $sql = "SELECT title, text, id FROM general WHERE user_id = :user_id ORDER BY id DESC";
        // Bind and filter.
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':user_id', $userid, \PDO::PARAM_STR);
        $query->execute();
        if($all = $query->fetchAll(\PDO::FETCH_ASSOC)){
            return $all;
        } else {
            return false;
        }
    }

    public function search($searched, $userid)
    {
        //Crete a connection
        $conn = Conn::getInstance();

        // The insert query.
        $sql = "SELECT title, text, id FROM general WHERE user_id = :user_id AND text LIKE :searched";
        // Bind and filter.
        $query = $conn->get()->prepare($sql);
        $query->execute(['user_id' => $userid, 'searched' => "%$searched%"]);
        $cards = $query->fetchAll(\PDO::FETCH_NUM);

        if (!empty($cards)) {
            foreach ($cards as $card){
                //remove tags from the content
                $card[1] = strip_tags($card[1]);
                if (strstr($card[1], $searched)){
                    $list[] = array('title'=>$card[0], 'content'=>strip_tags($card[1]), 'id'=>$card[2]);
                }
            }
            return isset($list) ? $list : false;
        } else {
            return false;
        }
    }

    public function actionListDomains($userid)
    {
        //Crete a connection
        $conn = Conn::getInstance();

        // The insert query.
        $sql = "SELECT DISTINCT domain FROM general WHERE user_id = :user_id";
        // Bind and filter.
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':user_id', $userid, \PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(\PDO::FETCH_NUM);
        //Check if there are any results
        if(!empty($results)) {
            foreach ($results as $row) {
                $domains[] = $row[0];
            }
            sort($domains);
            return $domains;
        } else {
            return null;
        }
    }

    public function actionFindByDomain($domain, $userid)
    {
        //Crete a connection
        $conn = Conn::getInstance();

        if ($domain === "All domains") {
            // The select query.
            $sql = "SELECT title, text, id FROM general WHERE user_id = :user_id ORDER BY id DESC";
            // Bind and filter.
            $query = $conn->get()->prepare($sql);
            $query->execute(['user_id' => $userid]);
            $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            // The select query.
            $sql = "SELECT title, text, id FROM general WHERE user_id = :user_id AND domain = :domain ORDER BY id DESC";
            // Bind and filter.
            $query = $conn->get()->prepare($sql);
            $query->execute(['user_id' => $userid, 'domain' => $domain]);
            $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        }
        foreach ($results as $card){
            $cards[] = array('title'=>$card['title'], 'id'=>$card['id']);
        }

        // Output the results of the search in the same layout
        foreach ($cards as $card) {
            echo "<div class=\"card\" onclick=\"on(); getCard(this.innerHTML)\">";
            echo "<div class=\"card_content\">";
            echo "<b id=\"content\">" . $card['title'] ."</b>";
            echo "<span id=\"identifier\">" . $card['id'] . "</span>";
            echo "</div>";
            echo "</div>";
        }
    }

}
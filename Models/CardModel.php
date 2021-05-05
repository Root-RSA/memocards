<?php

namespace Models;

use System\View;
use System\Security;
use System\Conn;

class CardModel
{
    public function actionCreate($user_id, $title, $content, $domain = null)
    {
        //Create a connection
        $conn = Conn::getInstance();

        // The insert query
        $sql = "INSERT INTO `general` (`user_id`,`title`, `text`, `domain`) VALUES (:user_id,:title,:content,:domain)";

        // Bind and filter
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':user_id',$user_id,\PDO::PARAM_STR);
        $query->bindParam(':title',$title,\PDO::PARAM_STR);
        $query->bindParam(':content',$content,\PDO::PARAM_STR);
        $query->bindParam(':domain',$domain,\PDO::PARAM_STR);

        // The id of the newly created row in the table.
        return $query -> execute() ? $conn->get()->lastInsertId() : false;
    }

    public function cardExists($title)
    {
        //Create a connection
        $conn = Conn::getInstance();

        //The select query
        $sql = "SELECT title FROM general WHERE title = :title";

        //Bind and filter
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':title',$title,\PDO::PARAM_STR);
        $query->execute();
        $card = $query -> fetch(\PDO::FETCH_ASSOC);
        if($card) {
            return $card;
        } else {
            return false;
        }
    }

    public function actionRead($id)
    {
        //Crete a connection
        $conn = Conn::getInstance();

        // The read query
        $sql = "SELECT text, title, id, domain, user_id FROM general WHERE id = :id";

        // Bind and filter.
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_STR);
        $query->execute();

        // Return the array of values
        return $query->fetch(\PDO::FETCH_ASSOC) ?: false;
    }

    public function actionDelete($id)
    {
        //Crete a connection
        $conn = Conn::getInstance();

        // The delete query
        $sql = "DELETE FROM general WHERE id = :id";

        // Bind and filter.
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_STR);
        return $query->execute();
    }

    public function actionUpdate($id, $title, $content, $domain)
    {
        //Crete a connection
        $conn = Conn::getInstance();

        // The update query.
        $sql = "UPDATE general SET title = :title, text = :content, domain = :domain WHERE id = :id";
        // Bind and filter.
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':title',$title,\PDO::PARAM_STR);
        $query->bindParam(':content',$content,\PDO::PARAM_STR);
        $query->bindParam(':id',$id,\PDO::PARAM_STR);
        $query->bindParam(':domain',$domain,\PDO::PARAM_STR);

        // The id of the newly created row in the table.
        return $query -> execute() ? true : false;
//        $result = $query -> execute();
//        echo $result;
    }
}
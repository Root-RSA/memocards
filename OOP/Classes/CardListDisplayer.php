<?php
namespace Classes;

class CardListDisplayer {

    private $conn;
    private $cardList = array();

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    public function findList($username)
    {
        // The insert query.
        $sql = "SELECT title, text FROM general WHERE username = :username";
        // Bind and filter.
        $query = $this->conn->get()->prepare($sql);
        $query->bindParam(':username', $username, \PDO::PARAM_STR);
        $query->execute();
        if($this->cardList = $query->fetchAll(\PDO::FETCH_NUM)){
            return true;
        } else {
            return false;
        }
    }

    function getCardList(){
        return $this->cardList;
    }
}
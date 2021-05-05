<?php
namespace Classes;

class CardGetter {

    private $conn;
    private $cardContent;

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    public function getCard($topic)
    {
        // The insert query.
        $sql = "SELECT text, id FROM general WHERE topic = :topic";
        // Bind and filter.
        $query = $this->conn->get()->prepare($sql);
        $query->bindParam(':topic', $topic, \PDO::PARAM_STR);
        $query->execute();
        $this->cardContent = $query->fetch(\PDO::FETCH_NUM);
        return $this->cardContent[0];
    }

    public function getId(){
        return $this->cardContent[1];
    }
}
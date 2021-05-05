<?php
namespace Classes;

class Searcher {

    private $conn;
    private $resultList;

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    public function search($username, $searchedText)
    {
        // The insert query.
        $sql = "SELECT topic, text FROM general WHERE username = :username AND text LIKE :searchedText";
        // Bind and filter.
        $query = $this->conn->get()->prepare($sql);
        $query->execute(['username' => $username, 'searchedText' => "%$searchedText%"]);
        $this->resultList = $query->fetchAll(\PDO::FETCH_NUM);
        return $this->resultList;
    }
}
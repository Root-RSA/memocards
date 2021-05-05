<?php
namespace Classes;

class CardMaker {

    private $conn;

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    function insert($username,$topic,$content)
    {
        // The insert query.
        $sql = "INSERT INTO `general`
        (`username`,`topic`, `text`)
        VALUES
        (:username,:topic,:content)";
        // Bind and filter.
        $query = $this->conn->get()->prepare($sql);
        $query->bindParam(':username',$username,\PDO::PARAM_STR);
        $query->bindParam(':topic',$topic,\PDO::PARAM_STR);
        $query->bindParam(':content',$content,\PDO::PARAM_STR);
        $query -> execute();
        // The id of the newly created row in the table.
        $lastInsertId = $this->conn->get()->lastInsertId();
        if($lastInsertId>0)
            return $lastInsertId;
        else
            return false;
    }
}
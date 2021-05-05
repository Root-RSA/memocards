<?php
namespace Classes;

class UserCreator {

    private $conn;
    private $check;

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    function check($username)
    {
        $sql = "SELECT id FROM users WHERE username = :username";
        $query = $this->conn->get()->prepare($sql);
        $query->bindParam(':username',$username,\PDO::PARAM_STR);
        $query -> execute();
        $this->check = $query -> fetch(\PDO::FETCH_NUM);
        if($this->check === false) {
            return false;
        } else {
            return true;
        }
    }

    function insert($username,$password)
    {
        // The insert query.
        $sql = "INSERT INTO `users`
        (`username`,`password`)
        VALUES
        (:username,:password)";
        // Bind and filter.
        $query = $this->conn->get()->prepare($sql);
        $query->bindParam(':username',$username,\PDO::PARAM_STR);
        $query->bindParam(':password',$password,\PDO::PARAM_STR);
        $query -> execute();
        // The id of the newly created row in the table.
        $lastInsertId = $this->conn->get()->lastInsertId();
        if($lastInsertId>0)
            return $lastInsertId;
        else
            return false;
    }
}
<?php
namespace Classes;

class SignIner {

    private $conn;
    private $check;

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    function check($username, $password)
    {
        $sql = "SELECT password FROM users WHERE username = :username";
        $query = $this->conn->get()->prepare($sql);
        $query->bindParam(':username',$username,\PDO::PARAM_STR);
        $query -> execute();
        $this->check = $query -> fetch(\PDO::FETCH_NUM);
        if($this->check === false) {
            return false;
        } else {
            return password_verify($password, $this->check[0]);
        }
    }
}
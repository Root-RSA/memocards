<?php

namespace Models;

use System\Conn;
use System\Security;

class UserModel
{

    public function create($username, $password)
    {
        //Connect to the db
        $conn = Conn::getInstance();

        // The insert query.
        $sql = "INSERT INTO `users` (`username`,`password`) VALUES (:username,:password)";

        // Bind and filter.
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':username',$username,\PDO::PARAM_STR);
        $query->bindParam(':password',$password,\PDO::PARAM_STR);
        return $query -> execute();
    }

    public function read()
    {
        //Connect to the db
        $conn = Conn::getInstance();

        $credentials = Security::sanitize();

        //The select query
        $sql = "SELECT id, password, email, token, status FROM users WHERE username = :username";

        //Bind and filter
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':username',$credentials['username'],\PDO::PARAM_STR);
        $query->execute();
        $user = $query -> fetch(\PDO::FETCH_ASSOC);
        if($user) {
            return $user;
        } else {
            return false;
        }

    }

    public function userExists($username)
    {
        //Connect to the db
        $conn = Conn::getInstance();

        //The select query
        $sql = "SELECT id FROM users WHERE username = :username";

        //Bind and filter
        $query = $conn->get()->prepare($sql);
        $query->bindParam(':username',$username,\PDO::PARAM_STR);
        $query->execute();
        $user = $query -> fetch(\PDO::FETCH_ASSOC);
        if($user) {
            return true;
        } else {
            return false;
        }
    }
}
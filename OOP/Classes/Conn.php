<?php
namespace Classes;

class Conn {
// Hold the handle for the PDO object in a private variable.
    private $dbh;
    private static $instance = null;

// Establish database connection
// or display an error message.
    private function __construct()
    {
        include('../settings.php');

        try {
            $this->dbh = new \PDO(
                sprintf(
                    'mysql:host=%s;dbname=%s',
                    $settings['host'],
                    $settings['dbname']
                ),
                $settings['username'],
                $settings['password'],
                array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
            );

        } catch (\PDOException $e) {
            echo 'The connection has not been established';
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Conn();
        }

        return self::$instance;
    }

// Method to get the database handler
// so it can be used outside of this class.
    function get()
    {
        return $this->dbh;
    }
// Set the PDO object to null to close the connection.
    function close()
    {
        $this->dbh = null;
    }
}
<?php
namespace Classes;

class CardDeleter {

    private $conn;

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    function delete($id)
    {
        // The update query.
        $sql = "DELETE FROM general WHERE id = :id";
        // Bind and filter.
        $query = $this->conn->get()->prepare($sql);
        $query->bindParam(':id',$id,\PDO::PARAM_STR);
        $query -> execute();
    }
}
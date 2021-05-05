<?php
namespace Classes;

class CardUpdater {

    private $conn;

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    function update($topic,$content, $id)
    {
        // The update query.
        $sql = "UPDATE general SET topic = :topic, text = :content WHERE id = :id";
        // Bind and filter.
        $query = $this->conn->get()->prepare($sql);
        $query->bindParam(':topic',$topic,\PDO::PARAM_STR);
        $query->bindParam(':content',$content,\PDO::PARAM_STR);
        $query->bindParam(':id',$id,\PDO::PARAM_STR);
        $query -> execute();
        // The id of the newly created row in the table.
        $lastInsertId = $this->conn->get()->lastInsertId();
        if($lastInsertId>0)
            return $lastInsertId;
        else
            return false;
    }
}
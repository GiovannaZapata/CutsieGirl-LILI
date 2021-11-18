<?php
include_once "../connection/Object_Connection.php";

class Cupon {
    private $conn;

    public $descripcion;

    function __construct($db) {
        $this->conn = $db;
    }

    function getCupon() {
        $query = "SELECT *
                  FROM u672703426_cutsiegirl.cupon
                  WHERE descripcion = :descripcion";

        $stmt = $this->conn->prepare($query);

        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));

        $stmt->bindParam(":descripcion", $this->descripcion);

        if($stmt->execute())
            return $stmt;
        else
            return 0;
    }
    
}
?>
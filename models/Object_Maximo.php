<?php
include_once "../connection/Object_Connection.php";

class Maximo {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    function getMaximo() {
        
        $query = "SELECT idArticulo,max(precio) FROM u672703426_cutsiegirl.inventario";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    }    
}
?>
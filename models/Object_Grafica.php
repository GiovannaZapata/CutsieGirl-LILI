<?php
include_once "../connection/Object_Connection.php";

class Grafica {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    function getGrafica() {
        
        $query = "SELECT p.nombre, SUM(c.cantidad) AS cantidad
                  FROM u672703426_cutsiegirl.compras c, u672703426_cutsiegirl.proveedores p
                  WHERE p.idProveedor = c.idProveedor
                  GROUP BY p.nombre";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    }
    
}
?>
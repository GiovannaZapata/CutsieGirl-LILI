<?php
include_once "../connection/Object_Connection.php";

class Proveedor {
    private $conn;

    public $idProveedor;

    public $nombre;

    function __construct($db) {
        $this->conn = $db;
    }

    function getProveedor() {
        $query = "SELECT idProveedor, nombre
                  FROM u672703426_cutsiegirl.proveedores";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0;
    }

}
?>
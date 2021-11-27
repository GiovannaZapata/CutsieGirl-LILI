<?php
include_once "../connection/Object_Connection.php";

class Maximo {
    private $conn;
    public  $idArticulo;

    function __construct($db) {
        $this->conn = $db;
    }

    function getMaximo() {
        
        $query = "SELECT a.nombre,max((b.existencia*b.precio))as mul FROM u672703426_cutsiegirl.articulo a, u672703426_cutsiegirl.inventario b where a.idArticulo=b.idArticulo";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    }    

    function getResurtir() {
        
        $query = "SELECT a.nombre,b.existencia, (c.nombre)as nomprov, c.telefono FROM u672703426_cutsiegirl.articulo a, u672703426_cutsiegirl.inventario b,u672703426_cutsiegirl.proveedores c where a.idArticulo=b.idArticulo and a.idProveedor=c.idProveedor having b.existencia<4";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    }   
}
?>
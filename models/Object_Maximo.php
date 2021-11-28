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
    function getMinimo(){
         
        $query = "SELECT b.nombre, min(a.cantidad) as cantidad, a.fecha
                FROM u672703426_cutsiegirl.compras a, u672703426_cutsiegirl.proveedores b
                WHERE a.idProveedor=b.idProveedor";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 
    }   

    function getResurtir() {
        
        $query = "SELECT a.nombre,b.existencia, (c.nombre)as nomprov, c.telefono 
        FROM u672703426_cutsiegirl.articulo a, u672703426_cutsiegirl.inventario b,u672703426_cutsiegirl.proveedores c 
        where a.idArticulo=b.idArticulo and a.idProveedor=c.idProveedor having b.existencia<4";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    }
    
    function getAuditoria(){

        $query = "CREATE TRIGGER `trigger_insert_usuario` AFTER INSERT ON `u672703426_cutsiegirl.usuario` 
        FOR EACH ROW INSERT into u672703426_cutsiegirl.auditoria (idUsuario,nombre,fecha,accion) VALUES (new.idUsuario,new.nombre,NOW(),'se agrego nuevo usuario')";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    }
}
?>
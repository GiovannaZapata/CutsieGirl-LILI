<?php

class Maximo {
    private $conn;
    public  $idArticulo;


    function __construct($db) {
        $this->conn = $db;
    }

    function getMaximo() {
        
        //$query = "SELECT a.nombre,max((b.existencia*b.precio))as mul FROM u672703426_cutsiegirl.articulo a, u672703426_cutsiegirl.inventario b where a.idArticulo=b.idArticulo";
        $query = "SELECT u.nombre, p.fecha, MAX(p.venta_total)as maxVenta FROM u672703426_cutsiegirl.usuario u, u672703426_cutsiegirl.pedido p WHERE u.idUsuario=p.idUsuario";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    } 
    function getMinimo(){
                 
        $query = "SELECT u.nombre, p.fecha, MIN(p.venta_total)as minVenta FROM u672703426_cutsiegirl.usuario u, u672703426_cutsiegirl.pedido p WHERE u.idUsuario=p.idUsuario";

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

    function getPedidoReciente(){

        $query = "SELECT idPedido,nombre_usuario,fecha,venta_total,idCupon from u672703426_cutsiegirl.pedido_reciente";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    }

    function getArticulosEliminados(){

        $query = "SELECT a.idArticulo,a.nombre,a.marca,a.descripcion,(b.nombre)as nomProveedor,(c.nombre)as nomCategoria from u672703426_cutsiegirl.delete_articulo a, 
        u672703426_cutsiegirl.proveedores b, u672703426_cutsiegirl.categoria c where a.idProveedor=b.idProveedor and c.idCategoria=a.idCategoria";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 

    }
    function getP1(){
        $query = "CALL p1()";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 
    }
    function busquedaArticulo(){
        $query = "CALL busquedaArt()";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0; 
    }

}

?>
<?php
include_once "../connection/Object_Connection.php";

class Venta {
    private $conn;

    public $idVenta;

    public $idInventario;
    public $cantidad;
    public $precio_venta;
    public $idNota;
    public $idCategoria;

    function __construct($db) {
        $this->conn = $db;
    }

    function addVenta() {
        
        $query = "INSERT INTO u672703426_cutsiegirl.venta
                  SET
                  idInventario = :idInventario,
                  cantidad = :cantidad,
                  precio_venta = :precio_venta,
                  idCategoria = :idCategoria,
                  idNota = :idNota";

        $stmt = $this->conn->prepare($query);

        $this->idInventario = htmlspecialchars(strip_tags($this->idInventario));
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        $this->precio_venta = htmlspecialchars(strip_tags($this->precio_venta));
        $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));
        $this->idNota = htmlspecialchars(strip_tags($this->idNota));
        
        $stmt->bindValue(":idInventario", $this->idInventario);
        $stmt->bindValue(":cantidad", $this->cantidad);
        $stmt->bindValue(":precio_venta", $this->precio_venta);
        $stmt->bindValue(":idCategoria", $this->idCategoria);
        $stmt->bindValue(":idNota", $this->idNota);

        if($stmt->execute())
            return $this->conn->lastInsertId();
        else
            return 0; 

    }

}
?>
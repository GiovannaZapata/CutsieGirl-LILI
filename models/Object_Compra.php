<?php
include_once "../connection/Object_Connection.php";

class Compra {
    private $conn;

    public $idCompra;

    public $idProveedor;
    public $idInventario;
    public $fecha;
    public $cantidad;

    function __construct($db) {
        $this->conn = $db;
    }

    function addCompra() {
        
        $query = "INSERT INTO u672703426_cutsiegirl.compras
                  SET
                  idProveedor = :idProveedor,
                  idInventario = :idInventario,
                  fecha = :fecha,
                  cantidad = :cantidad";

        $stmt = $this->conn->prepare($query);

        $this->idProveedor = htmlspecialchars(strip_tags($this->idProveedor));
        $this->idInventario = htmlspecialchars(strip_tags($this->idInventario));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
        $stmt->bindValue(":idProveedor", $this->idProveedor);
        $stmt->bindValue(":idInventario", $this->idInventario);
        $stmt->bindValue(":fecha", $this->fecha);
        $stmt->bindValue(":cantidad", $this->cantidad);

        if($stmt->execute())
            return $this->conn->lastInsertId();
        else
            return 0;

    }
  
}
?>
<?php
include_once "../connection/Object_Connection.php";

class Inventario {
    private $conn;

    public $idInventario;

    public $idArticulo;
    public $existencia;
    public $talla;
    public $status;
    public $precio;
    public $imagen;
    public $color;

    public $cantidad;

    function __construct($db) {
        $this->conn = $db;
    }

    function addInventario() {
        
        $query = "INSERT INTO u672703426_cutsiegirl.inventario
                  SET
                  idArticulo = :idArticulo,
                  existencia = :existencia,
                  talla = :talla,
                  status = :status,
                  precio = :precio,
                  imagen = :imagen,
                  color = :color";

        $stmt = $this->conn->prepare($query);

        $this->idArticulo = htmlspecialchars(strip_tags($this->idArticulo));
        $this->existencia = htmlspecialchars(strip_tags($this->existencia));
        $this->talla = htmlspecialchars(strip_tags($this->talla));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->imagen = htmlspecialchars(strip_tags($this->imagen));
        $this->color = htmlspecialchars(strip_tags($this->color));
        
        $stmt->bindValue(":idArticulo", $this->idArticulo);
        $stmt->bindValue(":existencia", $this->existencia);
        $stmt->bindValue(":talla", $this->talla);
        $stmt->bindValue(":status", $this->status);
        $stmt->bindValue(":precio", $this->precio);
        $stmt->bindValue(":imagen", $this->imagen);
        $stmt->bindValue(":color", $this->color);

        if($stmt->execute())
            return $this->conn->lastInsertId();
        else
            return 0; 
    }

    function getInventario() {//Modificar
        $query = "SELECT *
                  FROM u672703426_cutsiegirl.articulo";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute())
            return $stmt;
        else
            return 0;
    }

    function deleteInventario() {
        $query = "DELETE
                  FROM u672703426_cutsiegirl.inventario
                  WHERE idInventario = :idInventario";

        $stmt = $this->conn->prepare($query);

        $this->idInventario = htmlspecialchars(strip_tags($this->idInventario));

        $stmt->bindParam(":idInventario", $this->idInventario);

        if($stmt->execute())
            return 1;
        else
            return 0;
    }

    function editInventario() {
        $query = "UPDATE u672703426_cutsiegirl.inventario
                  SET precio = :precio,
                      existencia = :existencia
                  WHERE idInventario = :idInventario";
        
        $stmt = $this->conn->prepare($query);

        $this->idInventario = htmlspecialchars(strip_tags($this->idInventario));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->existencia = htmlspecialchars(strip_tags($this->existencia));

        $stmt->bindParam(":idInventario", $this->idInventario);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":existencia", $this->existencia);

        echo $stmt->execute();

    }

    function updateInventario() {
        $query = "UPDATE u672703426_cutsiegirl.inventario
                  SET existencia = existencia - :cantidad
                  WHERE idInventario = :idInventario";
        
        $stmt = $this->conn->prepare($query);

        $this->idInventario = htmlspecialchars(strip_tags($this->idInventario));
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));

        $stmt->bindParam(":idInventario", $this->idInventario);
        $stmt->bindParam(":cantidad", $this->cantidad);

        if($stmt->execute())
            return $stmt;
        else
            return 0;
    }
}
?>
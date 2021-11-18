<?php
include_once "../connection/Object_Connection.php";

class Articulo {
    private $conn;

    public $idArticulo;

    public $nombre;
    public $marca;
    public $descripcion;
    public $idProveedor;
    public $idCategoria;

    function __construct($db) {
        $this->conn = $db;
    }

    function addArticulo() {
        
        $query = "INSERT INTO u672703426_cutsiegirl.articulo
                  SET
                  nombre = :nombre,
                  marca = :marca,
                  idProveedor = :idProveedor,
                  idCategoria = :idCategoria,
                  descripcion = :descripcion";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->idProveedor = htmlspecialchars(strip_tags($this->idProveedor));
        $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        
        $stmt->bindValue(":nombre", $this->nombre);
        $stmt->bindValue(":marca", $this->marca);
        $stmt->bindValue(":idProveedor", $this->idProveedor);
        $stmt->bindValue(":idCategoria", $this->idCategoria);
        $stmt->bindValue(":descripcion", $this->descripcion);

        if($stmt->execute())
            return $this->conn->lastInsertId();
        else
            return 0; 

    }

    function getArticulo() {
        $query = "SELECT a.idArticulo, a.nombre, a.marca, a.descripcion, a.idCategoria,
                         i.idInventario, i.existencia, i.talla, i.precio, i.imagen, i.color
                  FROM u672703426_cutsiegirl.articulo a, u672703426_cutsiegirl.inventario i
                  WHERE a.idArticulo = i.idArticulo
                  AND status = 1
                  AND idCategoria = :idCategoria";

        $stmt = $this->conn->prepare($query);

        $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));

        $stmt->bindParam(":idCategoria", $this->idCategoria);

        if($stmt->execute())
            return $stmt;
        else
            return 0;
    }
    
    function deleteArticulo() {
        $query = "DELETE
                  FROM u672703426_cutsiegirl.articulo
                  WHERE idArticulo = :idArticulo";

        $stmt = $this->conn->prepare($query);

        $this->idArticulo = htmlspecialchars(strip_tags($this->idArticulo));

        $stmt->bindParam(":idArticulo", $this->idArticulo);

        if($stmt->execute())
            return 1;
        else
            return 0;
    }

    function editArticulo() {
        $query = "UPDATE u672703426_cutsiegirl.articulo
                  SET nombre = :nombre,
                  marca = :marca,
                  descripcion = :descripcion
                  WHERE idArticulo = :idArticulo";

        $stmt = $this->conn->prepare($query);

        $this->idArticulo = htmlspecialchars(strip_tags($this->idArticulo));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));

        $stmt->bindParam(":idArticulo", $this->idArticulo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":descripcion", $this->descripcion);

        echo $stmt->execute();
    }
}
?>
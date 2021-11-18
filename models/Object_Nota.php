<?php
include_once "../connection/Object_Connection.php";

class Nota {
    private $conn;

    public $idNota;

    public $idUsuario;
    public $fecha;
    public $venta_total;
    public $idCupon;

    function __construct($db) {
        $this->conn = $db;
    }

    function addNota() {
        
        $query = "INSERT INTO u672703426_cutsiegirl.nota
                  SET
                  idUsuario = :idUsuario,
                  fecha = :fecha,
                  venta_total = :venta_total,
                  idCupon = :idCupon";

        $stmt = $this->conn->prepare($query);

        $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->venta_total = htmlspecialchars(strip_tags($this->venta_total));
        $this->idCupon = htmlspecialchars(strip_tags($this->idCupon));
        
        $stmt->bindValue(":idUsuario", $this->idUsuario);
        $stmt->bindValue(":fecha", $this->fecha);
        $stmt->bindValue(":venta_total", $this->venta_total);
        $stmt->bindValue(":idCupon", $this->idCupon);

        if($stmt->execute())
            return $this->conn->lastInsertId();
        else
            return 0; 

    }

}
?>
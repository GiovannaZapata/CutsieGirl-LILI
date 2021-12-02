<?php
include_once '../connection/Object_Connection.php';


$database = new Database();
$db = $database->getConnection();

$vistaUs = new VistaUsuario($db);
$stmt = $vistaUs->vistaUsuario();

?>

<table width="50%">
    <tr>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Fecha de compra</th>
        <th>Total</th>
    </tr>	
    <?php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr>
        <td> <?php echo $result['nombre']; ?></td>
        <td> <?php echo $result['apellido_paterno']; ?></td>
        <td> <?php echo $result['apellido_materno']; ?></td>
        <td> <?php echo $result['fecha']; ?></td>
        <td> <?php echo $result['venta_total']; ?></td>
    </tr>
    <?php
}
      
    
class VistaUsuario{
    private $conn;

    function __construct($db) { 
        $this->conn = $db;
    }
    
    function vistaUsuario() {

        $query = "SELECT * FROM u672703426_cutsiegirl.usuariospedido";

        $stmt = $this->conn->prepare($query);
        if ($stmt->execute())
            return $stmt;
        else
            return 0;
    }
}
?>

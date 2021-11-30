<?php
include_once '../connection/Object_Connection.php';

$nombreProveedor=$_POST['nombreProveedor'];
$database = new Database();
$db = $database->getConnection();

$consulta = new Procedure($db);
$stmt = $consulta->consulta($nombreProveedor);

?>

<table width="50%">
    <tr>
        <th>idProveedor</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Calle</th>
        <th>Colonia</th>
        <th>No. Exterior</th>
        <th>Código postal</th>
    </tr>
    <?php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr>
        <td> <?php echo $result['idProveedor']; ?></td>
        <td> <?php echo $result['nombre']; ?></td>
        <td> <?php echo $result['telefono']; ?></td>
        <td> <?php echo $result['correo']; ?></td>
        <td> <?php echo $result['calle']; ?></td>
        <td> <?php echo $result['colonia']; ?></td>
        <td> <?php echo $result['numero']; ?></td>
        <td> <?php echo $result['cp']; ?></td>
    </tr>
    <?php
}
      
    
class Procedure{
    private $conn;

    function __construct($db) {
        
        $this->conn = $db;
    }
    
    function consulta($nombreProveedor) {

        $query = "CALL buscar_proveedor('$nombreProveedor')";

        $stmt = $this->conn->prepare($query);
        if ($stmt->execute())
            return $stmt;
        else
            return 0;
    }
}
?>

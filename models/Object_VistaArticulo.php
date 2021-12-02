<?php
include_once '../connection/Object_Connection.php';

//$nombreProveedor=$_POST['nombreProveedor'];
$database = new Database();
$db = $database->getConnection();

$vistaArt = new VistaArticulo($db);
$stmt = $vistaArt->vistaArticulo();

?>

<table width="50%">
    <tr>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Descripción</th>
        <th>Color</th>
        <th>Precio</th>
        <th>Talla</th>	
    </tr>
    <?php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr>
        <td> <?php echo $result['nombre']; ?></td>
        <td> <?php echo $result['marca']; ?></td>
        <td> <?php echo $result['descripcion']; ?></td>
        <td> <?php echo $result['color']; ?></td>
        <td> <?php echo $result['precio']; ?></td>
        <td> <?php echo $result['talla']; ?></td>
    </tr>
    <?php
}
      
    
class VistaArticulo{
    private $conn;

    function __construct($db) { 
        $this->conn = $db;
    }
    
    function vistaArticulo() {

        $query = "SELECT * FROM u672703426_cutsiegirl.articulosinventario";

        $stmt = $this->conn->prepare($query);
        if ($stmt->execute())
            return $stmt;
        else
            return 0;
    }
}
?>

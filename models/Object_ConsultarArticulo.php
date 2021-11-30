<?php
include_once '../connection/Object_Connection.php';

$nameArticulo=$_POST['nameArticulo'];
$database = new Database();
$db = $database->getConnection();

$consultarArt = new ConsultarArticulo($db);
$stmt = $consultarArt->consultarArticulo($nameArticulo);

?>

<table width="50%">
    <tr>
        <th>idArticulo</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Precio</th>
        <th>Descripción</th>
        <th>Proveedor</th>
        <th>Categoria</th>
    </tr>
    <?php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr>
        <td> <?php echo $result['idArticulo']; ?></td>
        <td> <?php echo $result['nombre']; ?></td>
        <td> <?php echo $result['marca']; ?></td>
        <td> <?php echo $result['precioArt']; ?></td>
        <td> <?php echo $result['descripcion']; ?></td>
        <td> <?php echo $result['nameProv']; ?></td>
        <td> <?php echo $result['nameCat']; ?></td>
    </tr>
    <?php
}
      
    
class ConsultarArticulo{
    private $conn;

    function __construct($db) {
        
        $this->conn = $db;
    }
    
    function consultarArticulo($nameArticulo) {

        $query = "CALL buscar_articulo('$nameArticulo')";

        $stmt = $this->conn->prepare($query);
        if ($stmt->execute())
            return $stmt;
        else
            return 0;
    }
}
?>

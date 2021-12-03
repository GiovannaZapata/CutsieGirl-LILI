<?php
include_once '../connection/Object_Connection.php';


$database = new Database();
$db = $database->getConnection();

$artMenosVendido = new ArticuloMenosVendido($db);
$stmt = $artMenosVendido->articuloMenosVendido();

?>

<table width="50%">
    <tr>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Proveedor</th>
        <th>Categoria</th>
        <th>Venta total</th>
    </tr>	
    <?php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr>
        <td> <?php echo $result['nombre']; ?></td>
        <td> <?php echo $result['marca']; ?></td>
        <td> <?php echo $result['proveedor']; ?></td>
        <td> <?php echo $result['categoria']; ?></td>
        <td> <?php echo $result['total_venta']; ?></td>
    </tr>
    <?php
}
      
    
class ArticuloMenosVendido{
    private $conn;

    function __construct($db) { 
        $this->conn = $db;
    }
    
    function articuloMenosVendido() {
        
        $query = "SELECT a.nombre,a.marca,(p.nombre)AS proveedor,(c.nombre)AS categoria,SUM(v.precio_venta) AS total_venta FROM u672703426_cutsiegirl.articulo a, u672703426_cutsiegirl.venta v, u672703426_cutsiegirl.inventario i, u672703426_cutsiegirl.categoria c, u672703426_cutsiegirl.proveedores p WHERE v.idInventario=i.idInventario AND i.idArticulo=a.idArticulo AND a.idCategoria=c.idCategoria AND p.idProveedor=a.idProveedor GROUP BY a.nombre ORDER BY total_venta ASC LIMIT 1";

        $stmt = $this->conn->prepare($query);
        if ($stmt->execute())
            return $stmt;
        else
            return 0;
    }
}
?>

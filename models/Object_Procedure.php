<?php
include_once '../connection/Object_Connection.php';

$nombreProveedor=$_POST['nombreProveedor'];
$database = new Database();
$db = $database->getConnection();

$consulta = new Procedure($db);
$stmt = $consulta->consulta($nombreProveedor);

$result = $stmt->fetch();
echo $result['nombre'];
//while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    
class Procedure{
    private $conn;

    function __construct($db) {
        
        $this->conn = $db;
    }
    
   function consulta($nombreProveedor){
       

    $query = "CALL buscar_proveedor('$nombreProveedor')";

    $stmt = $this->conn->prepare($query);
    if($stmt->execute())
        return $stmt;
    else
        return 0; 
        
   }
    

}
?>

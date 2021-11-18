<?php
include_once "../connection/Object_Connection.php";

class Login {
    private $conn;

    public $correo;
    public $contra;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    //public $direccion;
    public $colonia;
    public $cp;
    public $calle;
    public $numero;
    public $bloqueo;

    public $idUsuario;

    function __construct($db) {
        $this->conn = $db;
    }

    function setRegistro() {
        
        $query = "SELECT *
                  FROM u672703426_cutsiegirl.usuario
                  WHERE correo = :correo";

        $stmt = $this->conn->prepare($query);

        $this->correo = htmlspecialchars(strip_tags($this->correo));
        
        $stmt->bindValue(":correo", $this->correo);

        if(!$stmt->execute())
            return 0; 
        else {
            if($stmt->rowCount() > 0)
                return 0;
            else {
                $stmt = '';
                $query = "INSERT INTO u672703426_cutsiegirl.usuario
                          SET nombre = :nombre,
                          apellido_paterno = :apellido_paterno,
                          apellido_materno = :apellido_materno,
                          correo = :correo,
                          contra = :contra,
                          colonia = :colonia,
                          cp = :cp,
                          calle = :calle,
                          numero = :numero,
                          bloqueo = :bloqueo";
                
                $stmt = $this->conn->prepare($query);
                $this->contra = password_hash($this->contra, PASSWORD_BCRYPT);

                $this->correo = htmlspecialchars(strip_tags($this->correo));
                $this->nombre = htmlspecialchars(strip_tags($this->nombre));
                $this->apellido_paterno = htmlspecialchars(strip_tags($this->apellido_paterno));
                $this->apellido_materno = htmlspecialchars(strip_tags($this->apellido_materno));
                $this->contra = htmlspecialchars(strip_tags($this->contra));
                //$this->direccion = htmlspecialchars(strip_tags($this->direccion));
                $this->colonia = htmlspecialchars(strip_tags($this->colonia));
                $this->cp = htmlspecialchars(strip_tags($this->cp));
                $this->calle = htmlspecialchars(strip_tags($this->calle));
                $this->numero = htmlspecialchars(strip_tags($this->numero));
                $this->bloqueo = htmlspecialchars(strip_tags($this->bloqueo));
        
                $stmt->bindParam(":nombre", $this->nombre);
                $stmt->bindParam(":apellido_paterno", $this->apellido_paterno);
                $stmt->bindParam(":apellido_materno", $this->apellido_materno);
                $stmt->bindParam(":correo", $this->correo);
                $stmt->bindParam(":contra", $this->contra);
                //$stmt->bindParam(":direccion", $this->direccion);
                $stmt->bindParam(":colonia", $this->colonia);
                $stmt->bindParam(":cp", $this->cp);
                $stmt->bindParam(":calle", $this->calle);
                $stmt->bindParam(":numero", $this->numero);
                $stmt->bindParam(":bloqueo", $this->bloqueo);
                
                if($stmt->execute())
                    return "¡Registro exitoso!";
                else
                    return 0;
            }
        }

    }

    function login() {
        $query = "SELECT *
                  FROM u672703426_cutsiegirl.usuario
                  WHERE correo = :correo";

        $stmt = $this->conn->prepare($query);

        $this->correo = htmlspecialchars(strip_tags($this->correo));
        
        $stmt->bindValue(":correo", $this->correo);

        if(!$stmt->execute())
            return 0;
        else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row)
                return 0;//No hay correo registrado
            else {
                $this->bloqueo = $row['bloqueo'];
                if($this->bloqueo == 3)
                        return 3; //Cuenta bloqueada
                        
                if(password_verify($this->contra, $row['contra'])) {
                    session_start();
                    $_SESSION['idUsuario'] = $row['idUsuario'];
                    $_SESSION['nombreUsuario'] = $row['nombre'];
                    $_SESSION['apellidos'] = "$row[apellido_paterno] $row[apellido_materno]";
                    $_SESSION['correo'] = $row['correo'];
                    //$_SESSION['direccion'] = $row['direccion'];
                    $_SESSION['colonia'] = $row['colonia'];
                    $_SESSION['cp'] = $row['cp'];
                    $_SESSION['calle'] = $row['calle'];
                    $_SESSION['numero'] = $row['numero'];

                    $query = "UPDATE u672703426_cutsiegirl.usuario
                              SET bloqueo = 0
                              WHERE correo = :correo
                              AND idUsuario = :idUsuario";
                    
                    $stmt = $this->conn->prepare($query);

                    $this->idUsuario = $row['idUsuario'];

                    $this->correo = htmlspecialchars(strip_tags($this->correo));
                    $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));

                    $stmt->bindParam(":correo", $this->correo);
                    $stmt->bindParam(":idUsuario", $this->idUsuario);

                    $stmt->execute();
                    return 1;//Inicio de sesión
                }
                //Contraseña incorrecta
                $query = "UPDATE u672703426_cutsiegirl.usuario
                          SET bloqueo = :bloqueo
                          WHERE correo = :correo
                          AND idUsuario = :idUsuario";

                $this->idUsuario = $row['idUsuario'];
                $stmt = $this->conn->prepare($query);

                $this->bloqueo = htmlspecialchars(strip_tags($this->bloqueo + 1));
                $this->correo = htmlspecialchars(strip_tags($this->correo));
                $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));

                $stmt->bindParam(":bloqueo", $this->bloqueo);
                $stmt->bindParam(":correo", $this->correo);
                $stmt->bindParam(":idUsuario", $this->idUsuario);

                if($stmt->execute())

                if($this->bloqueo == 3)
                    return 2;//3er intento erróneo, bloqueado
                return -1;//Contraseña incorrecta
            }
        }
    }

    function resetPass() {
        $query = "SELECT *
                  FROM u672703426_cutsiegirl.usuario
                  WHERE correo = :correo";

        $stmt = $this->conn->prepare($query);

        $this->correo = htmlspecialchars(strip_tags($this->correo));
        
        $stmt->bindValue(":correo", $this->correo);

        if(!$stmt->execute())
            return 0;
        
        if($stmt->rowCount() < 1)
            return 0;//Correo no registrado


        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->idUsuario = $row['idUsuario'];
        $this->contra = password_hash($this->contra, PASSWORD_BCRYPT);
        
        $query = "UPDATE u672703426_cutsiegirl.usuario
                  SET contra = :contra,
                      bloqueo = :bloqueo
                  WHERE correo = :correo
                  AND idUsuario = :idUsuario";
        
        $stmt = $this->conn->prepare($query);

        $this->contra = htmlspecialchars(strip_tags($this->contra));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
        $this->bloqueo = htmlspecialchars(strip_tags($this->bloqueo));

        $stmt->bindParam(":contra", $this->contra);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":idUsuario", $this->idUsuario);
        $stmt->bindParam(":bloqueo", $this->bloqueo);
       
        if($stmt->execute())
            return 1;//Cambio exitoso
        else
            return 0;
    }
}
?>
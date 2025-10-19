<?php

class ConexionBD {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'tienda';
    private $port = 3306;
    private $conexion = null;

    public function __construct() {
        $this->connect();
    }

    private function connect(): void {
        $this->conexion = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->conexion->connect_error) {
            throw new Exception("No se pudo conectar a la base de datos tienda ({$this->conexion->connect_errno}): {$this->conexion->connect_error}");
        }
    }

    public function getConnection(): ?mysqli {
        return $this->conexion;
    }

    public function __destruct() {
        if ($this->conexion !== null) {
            $this->conexion->close();
        }
    }

    public function obtenerTodosEs(): array {
        $productos = [];
        $sql = "SELECT * FROM productoses";
        $resultado = $this->conexion->query($sql);
        if(!$resultado ){
            echo "La consulta falló";
        } else {
            if ($resultado->num_rows == 0){
                echo "No existen resultados";
            } else {
                while($producto = $resultado ->fetch_assoc()){
                    $productos[] = $producto;
                }
            }
        }
        return $productos;  
    }

    public function obtenerTodosEn(): array {
        $productos = [];
        $sql = "SELECT * FROM productosen";
        $resultado = $this->conexion->query($sql);
        if(!$resultado ){
            echo "La consulta falló";
        } else {
            if ($resultado->num_rows == 0){
                echo "No existen resultados";
            } else {
                while($producto = $resultado ->fetch_assoc()){
                    $productos[] = $producto;
                }
            }
        }
        return $productos;  
    }

    public function obtenerProductoEs(int $idConsultar): array {
        $producto = [];
        $sql = "SELECT * FROM productoses WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idConsultar);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if($resultado->num_rows == 0){
            echo "No existen resultados";
        } else {
            $producto = $resultado->fetch_assoc();
        }
        return $producto;
    }

    public function obtenerProductoEn(int $idConsultar): array {
        $producto = [];
        $sql = "SELECT * FROM productosen WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idConsultar);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if($resultado->num_rows == 0){
            echo "No existen resultados";
        } else {
            $producto = $resultado->fetch_assoc();
        }
        return $producto;
    }
}

?>
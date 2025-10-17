<?php
session_start();
require_once __DIR__ . '/conexionBD.php';
if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])) {
    header("Location:index.php");
}

$conexion = new ConexionBD();
$productosEs = $conexion->obtenerTodosEs();
$productosEn = $conexion->obtenerTodosEn();

echo "<h2>Productos en Español:</h2>";
foreach ($productosEs as $producto) {
    echo "ID: " . $producto['id'] . "<br>";
    echo "Nombre: " . $producto['nombre'] . "<br>";
    echo "Descripción: " . $producto['descripcion']. "<br>";
    echo "Precio: " . $producto['precio'] . "<br><br>";
}


echo "<h2>Productos en Inglés:</h2>";
foreach ($productosEn as $producto) {
    echo "ID: " . $producto['id'] . "<br>";
    echo "Nombre: " . $producto['name'] . "<br>";
    echo "Descripción: " . $producto['description'] . "<br>";
    echo "Precio: " . $producto['price'] . "<br><br>";
}

echo "<h2>Consultar Producto Específico:</h2>";
$Camiseta = $conexion->obtenerProductoEs(1);

echo "ID: " . $Camiseta['id'] . "<br>";
echo "Nombre: " . $Camiseta['nombre'] . "<br>"; 
echo "Descripción: " . $Camiseta['descripcion']. "<br>";
echo "Precio: " . $Camiseta['precio'] . "<br><br>";

$CamisetaEn = $conexion->obtenerProductoEn(1);
echo "ID: " . $CamisetaEn['id'] . "<br>";
echo "Nombre: " . $CamisetaEn['name'] . "<br>";
echo "Descripción: " . $CamisetaEn['description'] . "<br>";
echo "Precio: " . $CamisetaEn['price'] . "<br><br>";


?>

<html>
<head>
    <title>Carro de Compra</title>  
</head>
<body>
    <h1>Carro de Compra</h1>
    <h1>Bienvenido usuario: <?php echo $_SESSION['usuario']; ?></h1>
    <hr>
    <a href="cerrarsesion.php">Cerrar Sesion</a>
    <br>
</body>
</html>
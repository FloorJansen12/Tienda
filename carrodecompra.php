<?php
session_start();
require_once __DIR__ . '/conexionBD.php';
if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])) {
    header("Location:index.php");
}

$conexion = new ConexionBD();
$productosEs = $conexion->obtenerTodosEs();
$productosEn = $conexion->obtenerTodosEn();

$idioma = "es";
if (isset($_COOKIE["c_recordar"]) && isset($_COOKIE["Idioma"])) {
    $idioma = $_COOKIE["Idioma"];
}

$elementosCarrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];




// echo "<h2>Productos en Español:</h2>";
// foreach ($productosEs as $producto) {
//     echo "ID: " . $producto['id'] . "<br>";
//     echo "Nombre: " . $producto['nombre'] . "<br>";
//     echo "Descripción: " . $producto['descripcion']. "<br>";
//     echo "Precio: " . $producto['precio'] . "<br><br>";
// }


// echo "<h2>Productos en Inglés:</h2>";
// foreach ($productosEn as $producto) {
//     echo "ID: " . $producto['id'] . "<br>";
//     echo "Nombre: " . $producto['name'] . "<br>";
//     echo "Descripción: " . $producto['description'] . "<br>";
//     echo "Precio: " . $producto['price'] . "<br><br>";
// }

// echo "<h2>Consultar Producto Específico:</h2>";
// $Camiseta = $conexion->obtenerProductoEs(1);

// echo "ID: " . $Camiseta['id'] . "<br>";
// echo "Nombre: " . $Camiseta['nombre'] . "<br>"; 
// echo "Descripción: " . $Camiseta['descripcion']. "<br>";
// echo "Precio: " . $Camiseta['precio'] . "<br><br>";

// $CamisetaEn = $conexion->obtenerProductoEn(1);
// echo "ID: " . $CamisetaEn['id'] . "<br>";
// echo "Nombre: " . $CamisetaEn['name'] . "<br>";
// echo "Descripción: " . $CamisetaEn['description'] . "<br>";
// echo "Precio: " . $CamisetaEn['price'] . "<br><br>";


$textos = [
    'es' => [
        'nombre' => 'Nombre: ',
        'precio' => 'Precio: ',
    ],
    'en' => [
        'nombre' => 'Name: ',
        'precio' => 'Price: ',
    ]
];
$t = $textos[$idioma];

?>

<html>
<head>
    <title>Carro de Compra</title>  
</head>
<body>
    <h1>Carro de Compra</h1>
    <h1>Bienvenido usuario: <?php echo $_SESSION['usuario']; ?></h1>
    <p><a href="panelprincipal.php?idioma=<?php echo $idioma; ?>">Volver</a></p>

    <?php if(!empty($elementosCarrito)): ?>
        <h2>Productos en el carrito:</h2>
        <?php 
        $conexion = new ConexionBD();
        foreach($elementosCarrito as $item): 
            $producto = ($idioma == "en") 
                ? $conexion->obtenerProductoEn($item['id']) 
                : $conexion->obtenerProductoEs($item['id']);
        ?>
        <p><strong><?php echo $t['nombre']; ?>:</strong> 
            <?php echo ($idioma == "en") ? $producto['name'] : $producto['nombre']; ?>
        <p><strong><?php echo $t['precio']; ?>:</strong> 
            <?php echo number_format(($idioma == "en") ? $producto['price'] : $producto['precio'], 2); ?>
            <hr>
        <?php endforeach; ?>
        
    <?php else: ?>
        <p>El carrito está vacío</p>
    <?php endif; ?>
    <a href="cerrarsesion.php">Cerrar Sesion</a>
    <br>
</body>
</html>
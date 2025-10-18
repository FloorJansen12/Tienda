<?php
// Arrancar la sesión
session_start();
// Incluir la clase de conexión a la base de datos
require_once "ConexionBD.php";
// Verificar si el usuario desea recordar sus datos
$chkRecordar = isset($_COOKIE["c_recordar"]);
// Verificar si el usuario ha iniciado sesión
if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])){
    header("Location: index.php");
}
// valor por defecto del idioma (primera vez)
$idioma = "es"; 
// Si el usuario marcó Recordarme y existe cookie de idioma
if (isset($_COOKIE["c_recordar"]) && isset($_COOKIE["Idioma"])) {
    $idioma = $_COOKIE["Idioma"];
}

// Si el usuario cambió manualmente el idioma desde los enlaces
if (isset($_GET["idioma"])) {
    $idioma = $_GET["idioma"];
    if (isset($_COOKIE["c_recordar"]) && $_COOKIE["c_recordar"] == 1) {
        setcookie("Idioma", $idioma, 0); // Guardar si es que el usuario seleccionó recordar
    }
}

// Títulos en ambos idiomas
$titulo = ["Lista de Productos", "Product List"];

// Obtener productos según el idioma seleccionado
$conexion = new ConexionBD();
$productos = ($idioma == "en") ? $conexion->obtenerTodosEn() : $conexion->obtenerTodosEs();
?>

<html>
    <head>
    </head>
    <body>
        <h1>Panel Principal</h1>
        <h3>Bienvenido Usuario: <?php echo $_SESSION['usuario']; ?></h3>
        <!-- <h3>Bienvenido Usuario: Carlos></h3> -->

        <a href="panelprincipal.php?idioma=es">ES (Español)</a> /
        <a href="panelprincipal.php?idioma=en">EN (English)</a>
        <p><a href="carrodecompra.php">Carrito de Compra</a></p>
        <p><a href="cerrarsesion.php">Cerrar Sesion</a></p>
        
        
        <hr>
        <h2><?php echo $titulo[($idioma == "en") ? 1 : 0]; ?></h2>
        <hr>
        
        <?php
        $key = ($idioma == "en") ? 'name' : 'nombre';
        foreach($productos as $producto):
        ?>
            <a href="producto.php?id=<?php echo $producto['id'] ?>"><?php echo $producto[$key] ?></a> <br>
        <?php endforeach; ?>
    </body>
</html>
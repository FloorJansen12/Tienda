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
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, sans-serif;
                background-color: #f9fafc;
                margin: 0;
            }
            a {
                color: blue;
            }
            header nav a {
                color: white;
                text-decoration: none;
                font-weight: 500;
            }
            header {
                background-color: #3B4465;
                color: white;
                padding: 15px 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            h2 {
                margin-left: 30px;
            }
            .producto {
                background-color: #A7E245;
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 15px;
                text-align: center;
            }
            .producto a {
                text-decoration: none;
                color: #ffffffff;
                font-weight: 700;
            }
            .productos {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 20px;
                padding: 30px;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Panel Principal</h1>
            <h3>Bienvenido Usuario: <?php echo $_SESSION['usuario']; ?></h3>
            <!-- <h3>Bienvenido Usuario: Carlos></h3> -->
            <nav>
                <a href="panelprincipal.php?idioma=es">ES (Español)</a> /
                <a href="panelprincipal.php?idioma=en">EN (English)</a>
                <p><a href="carrodecompra.php">Carrito de Compra</a></p>
                <p><a href="cerrarsesion.php">Cerrar Sesion</a></p>    
            </nav>
        </header>
        <div>
            <br>
            <h2><?php echo $titulo[($idioma == "en") ? 1 : 0]; ?></h2>
        </div>  
        <div class="productos">
            <?php
            $key = ($idioma == "en") ? 'name' : 'nombre';
            foreach($productos as $producto):
            ?>
            <div class="producto">
                <a href="producto.php?id=<?php echo $producto['id'] ?>"><?php echo $producto[$key] ?></a>
            </div>
        <?php endforeach; ?>
    </body>
</html>
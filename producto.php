<?php
session_start();

require_once "conexionBD.php";

if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])){
    header("Location: index.php");
    exit();
}

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: panelprincipal.php");
    exit();
}

$idProducto = $_GET['id'];

$idioma = "es"; 

if (isset($_COOKIE["c_recordar"]) && isset($_COOKIE["Idioma"])) {
    $idioma = $_COOKIE["Idioma"];
}

$conexion = new ConexionBD();
$producto = ($idioma == "en") ? $conexion->obtenerProductoEn($idProducto) : $conexion->obtenerProductoEs($idProducto);

if(empty($producto)){
    header("Location: panelprincipal.php");
    exit();
}

if(isset($_POST['agregar_carrito'])){
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = [];
    }
    
    $productoCarrito = [
        'id' => $producto['id']
    ];
    
    $productoExiste = false;

    foreach($_SESSION['carrito'] as $key => $item){
        if($item['id'] == $producto['id']){
            $productoExiste = true;
            break;
        }
    }
    
    if(!$productoExiste){
        $_SESSION['carrito'][] = $productoCarrito;
    }
    
    $mensaje = ($idioma == "en") ? "Product added to cart!" : "¡Producto agregado al carrito!";
}

$textos = [
    'es' => [
        'titulo' => 'Detalles del Producto',
        'nombre' => 'Nombre',
        'descripcion' => 'Descripción',
        'precio' => 'Precio',
        'agregar' => 'Agregar al carro',
    ],
    'en' => [
        'titulo' => 'Product Details',
        'nombre' => 'Name',
        'descripcion' => 'Description',
        'precio' => 'Price',
        'agregar' => 'Add to Cart',
    ]
];

$t = $textos[$idioma];
?>

<html>
<head>
</head>
<body>
    <h1><?php echo $t['titulo']; ?></h1>
    
    <h3>Usuario: <?php echo $_SESSION['usuario']; ?></h3>
    
    <p><a href="panelprincipal.php?idioma=<?php echo $idioma; ?>">Volver</a></p>
    <p><a href="carrodecompra.php">Carrito de Compra</a></p>
    <p><a href="cerrarsesion.php">Cerrar Sesion</a></p>

    <hr>
    
    <?php if(isset($mensaje)): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>
    
    <h2><?php echo $t['titulo']; ?></h2>
    
    <p><strong>ID:</strong> <?php echo $producto['id']; ?></p>
    
    <p><strong><?php echo $t['nombre']; ?>:</strong> 
        <?php echo ($idioma == "en") ? $producto['name'] : $producto['nombre']; ?>
    </p>
    
    <p><strong><?php echo $t['descripcion']; ?>:</strong> 
        <?php echo ($idioma == "en") ? $producto['description'] : $producto['descripcion']; ?>
    </p>
    
    <p><strong><?php echo $t['precio']; ?>:</strong> 
        $<?php echo number_format(($idioma == "en") ? $producto['price'] : $producto['precio'], 2); ?>
    </p>
    
    <form method="POST" action="">
        <button type="submit" name="agregar_carrito">
            <?php echo $t['agregar']; ?>
        </button>
    </form>
</body>
</html>

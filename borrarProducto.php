<?php
session_start();

// Se verificar si hay un Id de producto para eliminar
if(isset($_POST['id'])) {
    // Se obtiene el id del producto
    $idEliminar = $_POST['id'];
    // Se verifica si el carrito existe y contiene productos
    if(isset($_SESSION['carrito'])) {
        // Se recorre el carrito para encontrar y eliminar el producto
        foreach($_SESSION['carrito'] as $indice => $item) {
            // Si se encuentra el producto, se elimina
            if($item['id'] == $idEliminar) {
                // Se elimina el producto del carrito
                unset($_SESSION['carrito'][$indice]);
                break;
            }
        }
        // Se reordena el array para evitar indices faltantes
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

// Volver al carrito
header("Location: carrodecompra.php");
exit();
?>

<?php 
session_start(); //Inicio de la sesión, clave si se utiliza sesiones    
if($_POST['nombre']=="test" && $_POST['clave']=="test123"){
    //Creo las sesiones
    $_SESSION["nombre"] = $_POST["nombre"];
    $_SESSION["clave"] = $_POST["clave"];
    header("Location:panelprincipal.php");
} else {
    header("Location:index.php");
}
?>

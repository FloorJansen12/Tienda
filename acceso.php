<?php 
session_start(); //Inicio de la sesión, clave si se utiliza sesiones    

$usuario = $_POST["usuario"];
$clave =$_POST["clave"];
$chkRecordar = isset($_POST["chkRecordar"]);

if($chkRecordar){
    //Seteo las cookies
    setcookie("c_usuario", $usuario, 0);
    setcookie("c_clave", $clave, 0);
    setcookie("c_recordar", $chkRecordar, 0);
} else {
    if(isset($_COOKIE)){
        foreach($_COOKIE as $name => $value){
            setcookie($name, "", 1); //Va a morir el 1 de enero de 1970 00:00:01
        }
    }
}


if($usuario=="test" && $clave=="test123"){
    //Creo las sesiones
    $_SESSION["usuario"] = $usuario;
    $_SESSION["clave"] = $clave;
    header("Location:panelprincipal.php");
} else {
    header("Location:index.php");
}

?>

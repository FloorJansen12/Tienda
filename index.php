<?php
$usuario = $clave = "";
$chkRecordar = false;


if(isset($_COOKIE['c_recordar']) && $_COOKIE['c_recordar']){
    $chkRecordar = true;
    $usuario = $_COOKIE['c_usuario'];
    $clave = $_COOKIE['c_clave'];
}

?>

<html lang="en">
<head>
    <title>Tienda</title>
</head>
<body>
    <h1>Login</h1>
    <form action="acceso.php" method="POST">
        <fieldset>
            Usuario <br> 
            <input type="text" name="usuario" value="<?php echo $usuario; ?>" require><br>
            Clave:<br>
            <input type="password" name="clave" value="<?php echo $clave; ?>" require/><br><br>
            <input type="checkbox" name="chkRecordar" <?php echo ($chkRecordar)? "checked": "";?>/>Recordarme<br><br>
            <input type="submit" value="Ingresar"/>
        </fieldset>
    </form>
</body>
</html>
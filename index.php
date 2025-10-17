<?php
$usuario = $clave = "";
$chkRecordar = false;

?>

<html lang="en">
<head>
    <title>Tienda</title>
</head>
<body>
    <h1>Login</h1>
    <form action="panelprincipal.php" method="POST">
        <fieldset>
            Usuario <br> 
            <input type="text" name="usuario" value=""/><br>
            Clave:<br>
            <input type="password" name="clave" value=""/><br><br>
            <input type="checkbox" name="chkRecordar"/>Recordarme<br><br>
            <input type="submit" value="Ingresar"/>
        </fieldset>
    </form>
</body>
</html>
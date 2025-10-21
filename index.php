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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f9fafc;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        fieldset {
            background-color: white;
            border: none;
            border-radius: 10px;
            padding: 25px;
            width: 300px;
        }
        .login {
            background-color: #3B4465;
            padding: 40px;
            border-radius: 15px;
        }
        h1 {
            color: white;
            text-align: center;
            margin-bottom: 15px;
        }
        fieldset input[type="submit"] {
            background-color: #A7E245;
            color: white;
            border: none;
            font-weight: 600;
            border-radius: 5px;
            padding: 10px 15px;
            width: 100%;
            cursor: pointer;
        }
        fieldset input[type="text"], fieldset input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <div class="login">
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
    </div>
</body>
</html>
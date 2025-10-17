<?php
session_start();

session_destroy();

if(isset($_COOKIE) && !$_COOKIE["c_recordar"] == 1){
    //borro las cookies y navego hacia el index.php
    foreach($_COOKIE as $name => $value){
        setcookie($name, "", 1); //Va a morir el 1 de enero de 1970 00:00:01
    }
    header("Location: index.php");
}       

header("Location:index.php");

?>
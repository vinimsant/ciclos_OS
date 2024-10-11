<?php
    $usuario = "root";
    $host = "localhost";
    $senha = "";
    $banco = "ciclos";

    $con = new mysqli($host, $usuario, $senha, $banco);
    if($con->connect_error){
        die("Conexâo falhou ".$con->connect_error);
    }

?>
<?php
    include('DAO_usuario.php');

    
    //verificar se está logado
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['nome'])){
        //matar a pagina
        die(header("Location: login.php"));
    }
    //nome do usuario logado
    echo "<p class='menu_login'>Usuario logado <strong>{$_SESSION['nome']}</strong></p>";

    $dao = new DAO_Usuario();

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ciclos OS</title>
</head>
<body>
    <nav>
        <a href="home.php">Home</a>
        <a href="inserir_objetos.php">Inserir Objeto</a>
        <a href="sair.php">Sair</a>
    </nav>
</body>
</html>
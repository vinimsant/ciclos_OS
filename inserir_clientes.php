<?php
    include('conexao.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['nome'])){
        //matar a pagina
        die(header("Location: login.php"));
    }
    //nome do usuario logado
    echo "<p class='menu_login'>Usuario logado <strong>{$_SESSION['nome']}</strong></p>";
    
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ciclos</title>
</head>
<body>
    <div>
        <h2>Cadastrar Clientes</h2>
        <form action="" class="formulario">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>
            <label for="cpf">CPF</label>
            <input type="number" id="cpf" name="cpf" minlength="11" maxlength="11" required>
            <label for="tel">Telefone</label>
            <input type="text" id="tel" name="tel" required>
            <label for="zap">WhatsApp</label>
            <input type="text" name="zap" id="zap" required>
            <input type="reset" value="Limpar">
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>
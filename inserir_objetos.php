<?php
    
    include("DAO.php");
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['nome'])){
        //matar a pagina
        die(header("Location: login.php"));
    }
    //nome do usuario logado
    echo "<p class='menu_login'>Usuario logado <strong>{$_SESSION['nome']}</strong></p>";

    try{
        $dao_clientes = new DAO_clientes();
        $dados_clientes = $dao_clientes->pesquisar_todos_clientes();
    }catch(Exception $e){
        echo "Erro ao pesquisar os clientes $e";
    }

    if(isset($_POST['dono'])){
        $valor = $_POST['dono'];
        echo "$valor";
    }
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
        <a href="objetos_manager.php">Objetos</a>
        <a href="sair.php">Sair</a>
    </nav>
    <h2>Cadastrar Objeto</h2>
    <form action="" method="post" class="formulario">
        <label for="marca">Marca</label>
        <input type="text" id="marca" name="macar" required>
        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" required>
        <label for="tipo">Tipo</label>
        <input type="text" id="tipo" name="tipo" required>
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" required></textarea>
        <label for="dono">Dono</label>
        <select name="dono" id="dono" required>
           <?php 
                foreach($dados_clientes as $cliente){
                    $nome = $cliente['nome'];
                    $cpf = $cliente['cpf'];
                    echo "<option value='$cpf'>$nome</option>";
                } 
            ?>
        </select>
        <input type="reset" value="Limpar">
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
<?php
    include('DAO_clientes.php');
    

        
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

    
    $nome_edit = $_SESSION['nome_editar'];
    $cpf_edit = $_SESSION['cpf_editar'];
    $tel_edit = $_SESSION['tel_editar'];
    $zap_edit = $_SESSION['zap_editar'];

    if(isset($_POST['nome'])&&isset($_POST['cpf'])&&isset($_POST['tel'])&&isset($_POST['zap'])){
        
        $cliente = new Clientes();
        $cliente->__set_nome($_POST['nome']);
        $cliente->__set_cpf($_POST['cpf']);
        $cliente->__set_tel($_POST['tel']);
        $cliente->__set_whatsaap($_POST['zap']);

        try{
            $dao = new DAO_clientes();
            $dao->atualizar_cliente($cliente);
            header(("Location: clientes_manager.php"));
        }catch(Exception $e){
            echo "<script>alert('erro ao atualizar cliente $e');</script>";
        }        
    }

    //botão cancelar
    if(isset($_POST['cancelar'])){
        header("Location:clientes_manager.php");
    }

    




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
    <nav>
        <a href="home.php">Home</a>
        <a href="clientes_manager.php">Clientes</a>
        <a href="sair.php">Sair</a>
    </nav>
    <div>
        <h2>Cadastrar Clientes</h2>
        <form action="" method="post" class="formulario">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" <?php echo "value='$nome_edit'";//popular o inpiut?> required>
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" minlength="11" maxlength="11" <?php echo "value='$cpf_edit'";//popular o inpiut?> required>
            <label for="tel">Telefone</label>
            <input type="text" id="tel" name="tel" <?php echo "value='$tel_edit'";//popular o inpiut?> required>
            <label for="zap">WhatsApp</label>
            <input type="text" name="zap" id="zap" <?php echo "value='$zap_edit'";//popular o inpiut?> required>
            <input type="reset" value="Limpar">
            <input type="submit" value="Salvar">
            <input type="submit" name="cancelar" value="Cancelar">
        </form>
    </div>
</body>
</html>
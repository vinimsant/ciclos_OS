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

    $dao = new DAO_clientes();

    $clientes = $dao->pesquisar_todos_clientes();

    //buscar usuario na tabela
    if(isset($_POST['cpf_busca'])){
        $cpf_busaca = $_POST['cpf_busca'];
        $clientes = $dao->buscar_cliente_pelo_cpf($cpf_busaca);
    }

    if(isset($_POST['excluir'])){//botão excluir
      
            $dao->deletar_cliente($_POST['cpf']);
            header('Location:clientes_manager.php');
        }elseif(isset($_POST['editar'])){
            $_SESSION['nome_editar'] = $_POST['nome'];
            $_SESSION['cpf_editar'] = $_POST['cpf'];
            $_SESSION['tel_editar'] = $_POST['tel'];
            $_SESSION['zap_editar'] = $_POST['zap'];
            header("Location: cliente_editar.php");
        }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <a href="home.php">Home</a>
        <a href="inserir_clientes.php">Inserir Clientes</a>
        <a href="sair.php">Sair</a>
    </nav>
    <div class="busca">
        <form action="" method="post">
            <label for="cpf">Pesquisar Cliente</label>
            <input type="text" id="cpf" name="cpf_busca" minlength="11" maxlength="11" class="cpf" required>
            <input type="submit" value="Buscar Cliente">
        </form>
        <a href="clientes_manager.php"><button>Buscar todos os Clientes</button></a>
    </div>
    <div class="tabela">
        <table>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Whatsap</th>
            </tr>
            <?php
                foreach($clientes as $cliente){
                    $nome = $cliente['nome'];
                    $cpf = $cliente['cpf'];
                    $tel = $cliente['telefone'];
                    $zap = $cliente['whatsap'];

                    echo "<tr>
                            <td>$nome</td>
                            <td>$cpf</td>
                            <td>$tel</td>
                            <td>$zap</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='cpf' value='$cpf'>
                                    <input type='hidden' name='nome' value='$nome'>
                                    <input type='hidden' name='tel' value='$tel'>
                                    <input type='hidden' name='zap' value='$zap'>
                                    <input type='submit' name='editar' value='Editar' id='editar_usuario'>
                                    <input type='submit' name='excluir' value='Excluir' id='excluir_usuario'>
                                </form>
                            </td>
                        </tr>";

                }
            ?>
        </table>
    </div>
</body>
</html>
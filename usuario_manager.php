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

    $usuarios = $dao->pesquisar_todos_usuario();
    
    if(isset($_POST['excluir'])){//botão excluir
        if($_SESSION['cpf']==$_POST['cpf']){//caso o usuario tente excluir a se proprio aparece um alert
            echo "<script>alert('Usuario não pode excluir o proprio usuario!');</script>";
        }else{
            $dao->deletar_usuario($_POST['cpf']);
            header('Location:usuario_manager.php');
        }
        
    }elseif(isset($_POST['editar'])){//botão editar
        if($_SESSION['cpf']==$_POST['cpf']){//caso o usuario tente editar a se proprio aparece um alert
            echo "<script>alert('Usuario não pode editar o proprio usuario!');</script>";
        }else{

            $_SESSION['nome_editar']=$_POST['nome'];
            $_SESSION['privilegio_editar']=$_POST['privilegio'];
            $_SESSION['senha_editar']=$_POST['senha'];
            $_SESSION['cpf_editar']=$_POST['cpf'];
            header('Location:usuario_editar.php');
        }
    }

    //buscar usuario na tabela
    if(isset($_POST['cpf_busca'])){
        $cpf_busaca = $_POST['cpf_busca'];
        $usuarios = $dao->buscar_usuario_pelo_cpf($cpf_busaca);
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
        <a href="usuario_inserir.php">Inserir Usuario</a>
        <a href="sair.php">Sair</a>
    </nav>
    <div class="busca">
        <form action="" method="post">
            <label for="cpf">Pesquisar Usuário</label>
            <input type="text" id="cpf" name="cpf_busca" minlength="11" maxlength="11" required>
            <input type="submit" value="Buscar Usuário">
        </form>
        <a href="usuario_manager.php"><button>Buscar todos os Usuários</button></a>
    </div>
    <div class="tabela">
        <table>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Privilégio</th>
                <th></th>
            </tr>
        
        <?php
            foreach ($usuarios as $usuario){
                $nome = $usuario['nome'];
                $cpf = $usuario['cpf'];
                $privilegio = $usuario['privilegio'];
                $senha = $usuario['senha'];
                echo "
                    <tr>
                        <td>$cpf</td>
                        <td>$nome</td>
                        <td>$privilegio</td>
                        <td>
                            <form action='' method='post'>
                                <input type='hidden' name='cpf' value='$cpf'>
                                <input type='hidden' name='senha' value='$senha'>
                                <input type='hidden' name='nome' value='$nome'>
                                <input type='hidden' name='privilegio' value='$privilegio'>
                                <input type='submit' name='editar' value='Editar' id='editar_usuario'>
                                <input type='submit' name='excluir' value='Excluir' id='excluir_usuario'>
                            </form>
                        </td>
                    </tr>  
                    ";
                
            }
        ?>
        </table>
    </div>
    <script src="script.js"></script>
</body>
</html>
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
    
    if(isset($_POST['excluir'])){
        if($_SESSION['cpf']==$_POST['cpf']){
            echo "<script>alert('Usuario não pode excluir o proprio usuario!');</script>";
        }else{
            $dao->deletar_usuario($_POST['cpf']);
            header('Location:usuario_manager.php');
        }
        
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
        <a href="usuario_inserir.php">Inserir Usuario</a>
        <a href="sair.php">Sair</a>
    </nav>
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
                echo "
                    <tr>
                        <td>$cpf</td>
                        <td>$nome</td>
                        <td>$privilegio</td>
                        <td>
                            <form action='' method='post'>
                                <input type='hidden' name='cpf' value='$cpf'>
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
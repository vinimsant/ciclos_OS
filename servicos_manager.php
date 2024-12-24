<?php
    include('DAO_servicos.php');

    
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

    $dao = new DAO_servicos();

    $servicos = $dao->pesquisar_todos_servicos();

    if(isset($_POST['excluir'])){//botão excluir
        
        $dao->deletar_servico($_POST['id']);
        header('Location:servicos_manager.php');
        
        
    }elseif(isset($_POST['editar'])){//botão editar
       

        $_SESSION['nome_editar']=$_POST['nome'];
        $_SESSION['descricao_editar']=$_POST['descricao'];
        $_SESSION['preco_editar']=$_POST['preco'];
        $_SESSION['id_editar']=$_POST['id'];
        header('Location:editar_servico.php');
        
    }

    //buscar usuario na tabela
    if(isset($_POST['id_busca'])){
        $id_busaca = $_POST['id_busca'];
        $servicos = $dao->buscar_servico_pelo_id($id_busaca);
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
    <!--menu da pagina-->
    <nav>
        <a href="home.php">Home</a>
        <a href="inserir_servicos.php">Inserir Serviço</a>
        <a href="sair.php">Sair</a>
    </nav>
    <!--campo de busca-->
    <div class="busca">
        <form action="" method="post">
            <label for="id">Pesquisar Serviço</label>
            <input type="text" id="id" name="id_busca" required>
            <input type="submit" value="Buscar Serviço">
        </form>
        <a href="servicos_manager.php"><button>Buscar todos os Serviços</button></a>
    </div>
    <!--tabela com os dados do banco de dados dos serviços-->
    <div class="tabela">
        <table>
            <tr>
                <th>
                    id
                </th>
                <th>
                    nome
                </th>
                <th>
                    descrição
                </th>
                <th>
                    preço
                </th>
            </tr>
                <?php
                    foreach ($servicos as $servico){
                        $nome = $servico['nome'];
                        $id = $servico['id'];
                        $descricao = $servico['descricao'];
                        $preco = $servico['valor'];
                        echo "
                            <tr>
                                <td>$id</td>
                                <td>$nome</td>
                                <td>$descricao</td>
                                <td>$preco</td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='hidden' name='descricao' value='$descricao'>
                                        <input type='hidden' name='nome' value='$nome'>
                                        <input type='hidden' name='preco' value='$preco'>
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
</body>
</html>
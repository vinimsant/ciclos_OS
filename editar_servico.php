<?php
    
    include("DAO_servicos.php");

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

    //recuperar variaveis do session
    $nome = $_SESSION['nome_editar'];
    $descricao = $_SESSION['descricao_editar'];
    $preco = $_SESSION['preco_editar'];
    $id = $_SESSION['id_editar'];
    
    $servico_crud = new Servicos();
    
    if(isset($_POST['nome'])&&isset($_POST['descricao'])&&isset($_POST['preco'])){
        $servico_crud->__set_nome_servico($_POST['nome']);
        $servico_crud->__set_descricao_servico($_POST['descricao']);
        $servico_crud->__set_preco_servico($_POST['preco']);
        $servico_crud->__set_id_servico($id);
        try{
            $dao = new DAO_servicos();
            
            $dao->atualizar_servico($servico_crud);
            header("Location: servicos_manager.php");
            
        }catch(Exception $e){
            echo "Erro ao salvar usuario $e";
        }
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
        <a href="servicos_manager.php">Serviços</a>
        <a href="sair.php">Sair</a>
    </nav>
    <h2>Editar Serviço</h2>
    <form action="" method="post" class="formulario">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" <?php echo "value='$nome'";?> required>
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" required><?php echo "$descricao";?> </textarea>
        <label for="preco">Preço</label>
        <input type="number" id="preco" name="preco" step="0.01" <?php echo "value='$preco'";?> required>
        <input type="reset" value="Limpar">
        <input type="submit" value="Salvar">
    </form>
</body>
</html> 
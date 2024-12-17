<?php
    
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
    $privilegio_edit = $_SESSION['privilegio_editar'];
    $senha_edit = $_SESSION['senha_editar'];    


    include("DAO_usuario.php");
    
    $usuario_crud = new Usuario();
    
    if(isset($_POST['nome'])&&isset($_POST['cpf'])&&isset($_POST['senha'])&&isset($_POST['privilegio'])){
        $usuario_crud->__set_nome($_POST['nome']);
        $usuario_crud->__set_senha($_POST['senha']);
        $usuario_crud->__set_cpf($_POST['cpf']);
        $usuario_crud->__set_privilegio($_POST['privilegio']);
        try{
            $dao = new DAO_Usuario();
            $dao->atualizar_usuario($usuario_crud);
            header("Location: usuario_manager.php");
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
    <title>Ciclos</title>
</head>
<body>
    <nav>
        <a href="home.php">Home</a>
        <a href="usuario_manager.php">Usuários</a>
        <a href="sair.php">Sair</a>
    </nav>
    <h2>Editar Usuario</h2>
    <form action="" method="post" class="formulario">
        <?php
        //quando a pagina for chamada pelo botão de editar os codigos abaixo vão popular os inputs
        
            

            echo "
                <label for='nome'>Nome</label>
                <input type='text' id='nome' name='nome' value='$nome_edit' required>
                <label for='cpf'>CPF</label>
                <input type='text' id='cpf' name='cpf' minlength='11' maxlength='11' value='$cpf_edit' required>
                <label for='senha'>Senha</label>
                <input type='password' id='senha' name='senha' value='$senha_edit' required>
                <label for='privilegio'>Privilégio</label>
                ";
            switch($privilegio_edit){//popular o selection
                case "administrador":
                    echo "
                        <select name='privilegio' id='privilegio'>                        
                        <option value='administrador'>administrador</option>
                        <option value='funcionário'>funcionário</option>
                        </select>";
                    break;
                case "funcionário":
                    echo "
                        <select name='privilegio' id='privilegio'>
                        <option value='funcionário'>funcionário</option>
                        <option value='administrador'>administrador</option>
                        </select>";
                    break;
            }
        
        
        
        
        ?>
        <input type="reset" value="Limpar">
        <input type="submit" value="Salvar">
    </form>
</body>
</html> 
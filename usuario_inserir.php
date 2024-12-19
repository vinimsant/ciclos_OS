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
    
    


    include("DAO_usuario.php");
    
    $usuario_crud = new Usuario();
    
    if(isset($_POST['nome'])&&isset($_POST['cpf'])&&isset($_POST['senha'])&&isset($_POST['privilegio'])){
        $usuario_crud->__set_nome($_POST['nome']);
        $usuario_crud->__set_senha($_POST['senha']);
        $usuario_crud->__set_cpf($_POST['cpf']);
        $usuario_crud->__set_privilegio($_POST['privilegio']);
        try{
            $dao = new DAO_Usuario();
            //verificar se o cpf já está cadastrado no banco
            $usuario_pesquisado = $dao->buscar_usuario_pelo_cpf($usuario_crud->__get_cpf());
            
            if(count($usuario_pesquisado, 1)>0){//o modo conta todos os sub arrays
                echo "<script>alert('Já existe um usuário cadatrado com esse cpf!');</script>";
             }else{
                $dao->Inserir_usuario($usuario_crud);
                header("Location: usuario_manager.php");
            }
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
    <h2>Cadastrar Usuario</h2>
    <form action="" method="post" class="formulario">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" minlength="11" maxlength="11" required>
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>
        <label for="privilegio">Privilégio</label>
        <select name="privilegio" id="privilegio">
            <option value="funcionário">funcionário</option>
            <option value="administrador">administrador</option>
        </select>
        <input type="reset" value="Limpar">
        <input type="submit" value="Salvar">
    </form>
</body>
</html> 
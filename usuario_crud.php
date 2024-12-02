<?php

    include("DAO_usuario.php");
    
    $usuario_crud = new Usuario();
    
    if(isset($_POST['nome'])&&isset($_POST['cpf'])&&isset($_POST['senha'])&&isset($_POST['privilegio'])){
        $usuario_crud->__set_nome($_POST['nome']);
        $usuario_crud->__set_senha($_POST['senha']);
        $usuario_crud->__set_cpf($_POST['cpf']);
        $usuario_crud->__set_privilegio($_POST['privilegio']);
        try{
            $dao = new DAO_Usuario();
            $dao->Inserir_usuario($usuario_crud);
            header("Location: home.php");
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
    <h2>Cadastrar Usuario</h2>
    <form action="" method="post" class="form">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" required>
        <label for="senha">Senha</label>
        <input type="text" id="senha" name="senha" required>
        <label for="privilegio"></label>
        <input type="text" id="privilegio" name="privilegio" required>
        <input type="reset" value="Limpar">
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
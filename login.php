<?php
include("DAO_usuario.php");
    if(isset($_POST['txt_cpf'])&&isset($_POST['txt_senha'])){
        $usuario = $_POST['txt_cpf'];
        $senha = $_POST['txt_senha'];
        
        try{
            $dao = new DAO_Usuario();
            $dados = $dao->buscar_usuario_pelo_cpf($usuario);
            foreach($dados as $row){
                if($usuario==$row['cpf']&&$senha==$row['senha']){
                    if(!isset($_SESSION)){
                        session_start();
                    }
                    $_SESSION['cpf'] = $row['cpf'];
                    $_SESSION['privilegio'] = $row['privilegio'];
                    $_SESSION['nome'] = $row['nome'];
                    //direcionar para a pagina dependendo do nivel de acesso do usuario
                    if($_SESSION['privilegio'] == "administrador"){
                        header("Location: home.php");
                    }elseif($_SESSION['privilegio'] == "funcionário"){
                        header("Location: home_funcionario.php");
                    }
                }
            }
        }catch(Exception $e){
            echo "Erro no sql $e";
        }
    }




?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Sistema OS Ciclos</title>
</head>
<body>
    <form action="" method="post" class="formulario" id="form_login">
        <label for="txt_cpf" class="form_login">Digite o CPF</label>
        <input type="text" class="form_login" id="txt_cpf" name="txt_cpf" minlength="11" maxlength="11" required>
        <label for="txt_senha" class="form_login">Digite sua Senha</label>
        <input type="password" class="form_login" id="txt_senha" name="txt_senha" required>
        <input type="reset" class="form_login" value="Limpar" class="botao">
        <input type="submit" class="form_login" value="Entrar" class="botao">
    </form>
</body>
</html>
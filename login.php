<?php
include('conexao.php');
    if(isset($_POST['txt_cpf'])&&isset($_POST['txt_senha'])){
        $usuario = $_POST['txt_cpf'];
        $senha = $_POST['txt_senha'];
        $sql = "SELECT * FROM usuarios WHERE cpf = $usuario";
        try{
            $dados = $con->query($sql);
            while($row = $dados->fetch_assoc()){
                if($usuario==$row['cpf']&&$senha==$row['senha']){
                    if(!isset($_SESSION)){
                        session_start();
                    }
                    $_SESSION['cpf'] = $row['cpf'];
                    $_SESSION['privilegio'] = $row['privilegio'];
                    $_SESSION['nome'] = $row['nome'];
                    header("Location: home.php");
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
        <label for="txt_cpf">Digite o CPF</label>
        <input type="text" id="txt_cpf" name="txt_cpf" minlength="11" maxlength="11" required>
        <label for="txt_senha">Digite sua Senha</label>
        <input type="password" id="txt_senha" name="txt_senha" required>
        <input type="reset" value="Limpar" class="botao">
        <input type="submit" value="Salvar" class="botao">
    </form>
</body>
</html>
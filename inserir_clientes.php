<?php
    include('DAO.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['nome'])){
        //matar a pagina
        die(header("Location: login.php"));
    }
    //nome do usuario logado
    echo "<p class='menu_login'>Usuario logado <strong>{$_SESSION['nome']}</strong></p>";

    //instanciar objeto dao cliente
    $dao = new DAO_clientes();
    //instaciar objeto cliente
    $cliente = new Clientes();

    //recuperando objetos
    if(isset($_POST['cpf'])&&isset($_POST['nome'])&&isset($_POST['tel'])&&isset($_POST['zap'])){
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $tel = $_POST['tel'];
        $zap = $_POST['zap'];
        $cliente->__set_cpf($cpf);
        $cliente->__set_nome($nome);
        $cliente->__set_tel($tel);
        $cliente->__set_whatsaap($zap);


        try{
            //verificar se o cpf já está no banco
            $cliente_pesquisado = $dao->buscar_cliente_pelo_cpf($cpf);
            if(count($cliente_pesquisado, 1)>0){//o modo conta todos os sub arrays
                echo "<script>alert('Já existe um usuário cadatrado com esse cpf!');</script>";
            }else{//caso o cliente não exista salva ele no banco
                $dao->inserir_cliente($cliente);
                header("Location: clientes_manager.php");
            }
            
        }catch(Exception $e){
            echo "Erro ao salvar cliente $e";
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
        <a href="clientes_manager.php">Clientes</a>
        <a href="sair.php">Sair</a>
    </nav>
    <div>
        <h2>Cadastrar Clientes</h2>
        <form action="" method="post" class="formulario">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" minlength="11" maxlength="11" required>
            <label for="tel">Telefone</label>
            <input type="text" id="tel" name="tel" required>
            <label for="zap">WhatsApp</label>
            <input type="text" name="zap" id="zap" required>
            <input type="reset" value="Limpar">
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>
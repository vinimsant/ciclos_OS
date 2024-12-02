<?php
    include('conexao.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['nome'])){
        //matar a pagina
        die(header("Location: login.php"));
    }
    //nome do usuario logado
    echo $_SESSION['nome'];
    
    
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
    <header>
        <nav>
            <a href="">Clientes</a>
            <a href="">Objetos</a>
            <a href="usuario_crud.php">Usuarios</a>
            <!-- botão sair  -->
            <a href="sair.php" id="btn_sair">Sair</a>
        </nav>
        
        <form action="" method="post" class="formulario">
            <!-- seletro de clientes-->
            <label for="select_clientes">Escolha o Cliente</label>
            <select name="seletor_cliente" id="select_clientes" class="seletor">
            <?php
                $sql = "SELECT * FROM clientes";
                $dados = $con->query($sql);
                while($row = $dados->fetch_assoc()){
                    $nome_cliente = $row['nome'];
                    $id_cliente = $row['cpf'];
                    ?>
                    <option value="<?php echo $id; ?>"><?php echo $nome_cliente; ?></option>

                    <?php
                }
            ?>
            </select>

            <!--seletor do objeto-->
            <label for="select_obojeto">Escolha o objeto</label>
            <select name="seletor_objeto" id="select_obojeto" class="seletor">
            <?php
                $sql = "SELECT * FROM objeto_em_concerto";
                $dados_objetos = $con->query($sql);
                while($row = $dados_objetos->fetch_assoc()){
                    $objeto = $row['descricao'];
                    $id = $row['id'];
                    $marca = $row['marca'];
                    $modelo = $row['modelo'];
                     
                    ?>
                    <option value="<?php echo $id; ?>"><?php echo $objeto; ?></option>

                    <?php
                }
            ?>
            </select>

            <!--seletor de serviço-->
            <label for="selct_servico">Escolha o Serviço</label>
            <select name="seletor_servico" id="selct_servico" class="seletor">
            <?php
                $sql = "SELECT * FROM servicos";
                $dados = $con->query($sql);
                while($row = $dados->fetch_assoc()){
                    $servico = $row['nome'];
                    $valor = $row['valor'];
                    $descricao = $row['descricao'];
                    $id = $row['id']; 
                    ?>
                    <option value="<?php echo $id; ?>"><?php echo $servico; ?></option>

                    <?php
                }
            ?>
            </select>

            <!--seletro de usuario-->
            <label for="selct_usuario">Escolha o Mecânico</label>
            <select name="seletor_usuario" id="selct_usuario" class="seletor">
            <?php
                $sql_usuario = "SELECT * FROM usuarios";
                $dados_usuario = $con->query($sql_usuario);
                while($row = $dados_usuario->fetch_assoc()){
                    $cpf_usuario = $row['cpf'];
                    $usuario = $row['nome']; 
                    ?>
                    <option value="<?php echo $cpf_usuario; ?>"><?php echo $usuario; ?></option>
                    <?php
                }
            ?>
            </select>


        </form>
    </header>
</body>
</html>
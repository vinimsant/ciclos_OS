<?php

    include('conexao.php');
    include('clientes.php');
    include('servicos.php');
    include('usuario.php');
    include('objetos.php');

    class DAO_clientes{

        private $conn;

        public function __construct(){

            $conexao = new Conexao();

            $this->conn = $conexao->conectar();
        }

        public function inserir_cliente($cliente){
            try{
                $stmt = $this->conn->prepare("INSERT INTO clientes (cpf, nome, telefone, whatsap) values(:cpf, :nome, :telefone, :whatsap)");
                //passando o objetos para o prepare
                $stmt->bindValue(":cpf", $cliente->__get_cpf());
                $stmt->bindValue(":telefone", $cliente->__get_tel());
                $stmt->bindValue(":nome", $cliente->__get_nome());
                $stmt->bindValue(":whatsap", $cliente->__get_whatsaap());
                $stmt->execute();
            }catch(Exception $e){
                echo "Erro ao inserir Cliente $e";
            }
        }

        public function atualizar_cliente($cliente){
            try{
                $sql = "UPDATE clientes SET nome = :nome, telefone = :telefone, whatsap = :whatsap WHERE cpf = :cpf";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":cpf", $cliente->__get_cpf());
                $stmt->bindValue(":nome", $cliente->__get_nome());
                $stmt->bindValue(":telefone", $cliente->__get_tel());
                $stmt->bindValue(":whatsap", $cliente->__get_whatsaap());
                $stmt->execute();

            }catch(Exception $e){
                echo "Erro ao atualizar cliente $e";
            }
        }

        public function pesquisar_todos_clientes(){
            try{
                $sql = "SELECT * FROM clientes";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao pesquisar cliente $e";
                return null;
            }
        }

        public function buscar_cliente_pelo_cpf($cpf){
            try{
                $sql = "SELECT * FROM clientes WHERE cpf = :cpf";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":cpf", $cpf);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao buscar cliente $e";
                return null;
            }
        }

        public function deletar_cliente($cpf){
            try{
                $sql = "DELETE FROM clientes WHERE cpf = :cpf";
                //poderia ter usado bindParam também
                // $stmt = $pdo->prepare('DELETE FROM minhaTabela WHERE id = :id');
                // $stmt->bindParam(':id', $id);
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":cpf", $cpf);
                $stmt->execute();
                echo "Cliente excluido com sucesso";

            }catch(Exception $e){
                echo "Erro ao excluir cliente $e";
            }
        }

    }


    class DAO_objetos{

        private $conn;

        public function __construct(){

            $conexao = new Conexao();

            $this->conn = $conexao->conectar();
        }

        public function inserir_objetos($objeto){
            try{
                $stmt = $this->conn->prepare("INSERT INTO objeto_em_concerto (marca, modelo, tipo, descricao, dono) values(:marca, :modelo, :tipo, :descricao, :dono)");
                //passando o objetos para o prepare
                $stmt->bindValue(":marca", $objeto->__get("marca"));
                $stmt->bindValue(":modelo", $objeto->__get("modelo"));
                $stmt->bindValue(":tipo", $objeto->__get("tipo"));
                $stmt->bindValue(":descricao", $objeto->__get("descricao"));
                $stmt->bindValue(":dono", $objeto->__get("dono"));
                $stmt->execute();
            }catch(Exception $e){
                echo "Erro ao inserir Objeto $e";
            }
        }

        public function atualizar_cliente($objeto){
            try{
                $sql = "UPDATE objeto_em_concerto SET marca = :marca, modelo = :modelo, tipo = :tipo, descricao = :descricao WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":marca", $objeto->__get("marca"));
                $stmt->bindValue(":modelo", $objeto->__get("modelo"));
                $stmt->bindValue(":tipo", $objeto->__get("tipo"));
                $stmt->bindValue(":descricao", $objeto->__get("descricao"));
                $stmt->bindValue(":dono", $objeto->__get("dono"));
                $stmt->execute();

            }catch(Exception $e){
                echo "Erro ao atualizar objeto $e";
            }
        }

        public function pesquisar_todos_objetos(){
            try{
                $sql = "SELECT * FROM objeto_em_concerto ORDER BY dono";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao pesquisar objeto $e";
                return null;
            }
        }

        public function buscar_objeto_pelo_id($id){
            try{
                $sql = "SELECT * FROM objeto_em_concerto WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao buscar objeto $e";
                return null;
            }
        }

        public function deletar_cliente($id){
            try{
                $sql = "DELETE FROM objeto_em_concerto WHERE id = :id";
                //poderia ter usado bindParam também
                // $stmt = $pdo->prepare('DELETE FROM minhaTabela WHERE id = :id');
                // $stmt->bindParam(':id', $id);
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                echo "Objeto excluido com sucesso";

            }catch(Exception $e){
                echo "Erro ao excluir objeto $e";
            }
        }

    }

    class DAO_servicos{

        private $conn;

        public function __construct(){

            $conexao = new Conexao();

            $this->conn = $conexao->conectar();
        }

        public function inserir_servico($servico){
            try{
                $stmt = $this->conn->prepare("INSERT INTO servicos (id, nome, descricao, valor) values(:id, :nome, :descricao, :preco)");
                //passando o objetos para o prepare
                $stmt->bindValue(":id", $servico->__get_id_servico());
                $stmt->bindValue(":descricao", $servico->__get_descricao_servico());
                $stmt->bindValue(":nome", $servico->__get_nome_servico());
                $stmt->bindValue(":preco", $servico->__get_preco_servico());
                $stmt->execute();
            }catch(Exception $e){
                echo "Erro ao inserir serviço $e";
            }
        }

        public function atualizar_servico($servico){
            try{
                $sql = "UPDATE servicos SET nome = :nome, descricao = :descricao, valor = :preco WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":id", $servico->__get_id_servico());
                $stmt->bindValue(":nome", $servico->__get_nome_servico());
                $stmt->bindValue(":descricao", $servico->__get_descricao_servico());
                $stmt->bindValue(":preco", $servico->__get_preco_servico());
                $stmt->execute();

            }catch(Exception $e){
                echo "Erro ao atualizar serviço $e";
            }
        }

        public function pesquisar_todos_servicos(){
            try{
                $sql = "SELECT * FROM servicos";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao pesquisar serviço $e";
                return null;
            }
        }

        public function buscar_servico_pelo_id($id){
            try{
                $sql = "SELECT * FROM servicos WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao buscar serviço $e";
                return null;
            }
        }

        public function buscar_servico_pelo_nome($nome){
            try{
                $sql = "SELECT * FROM servicos WHERE nome = :nome";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":nome", $nome);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao buscar serviço $e";
                return null;
            }
        }

        public function deletar_servico($id){
            try{
                $sql = "DELETE FROM servicos WHERE id = :id";
                //poderia ter usado bindParam também
                // $stmt = $pdo->prepare('DELETE FROM minhaTabela WHERE id = :id');
                // $stmt->bindParam(':id', $id);
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                //echo "Serviço excluido com sucesso";

            }catch(Exception $e){
                echo "Erro ao excluir serviço $e";
            }
        }

    }


    class DAO_Usuario {

        private $conn;

        public function __construct(){
            // criando a classe ou objeto conexão
            $conexao = new Conexao();
            // pegando o objeto conexão que é retorno do metodo
            $this->conn = $conexao->conectar();              
        }
        
        

        public function Inserir_usuario($usuario){
            

            try{             
                $stmt = $this->conn->prepare("INSERT INTO usuarios (cpf, nome, senha, privilegio) values(:cpf, :nome, :senha, :privilegio)");
                // pegando o objeto usuario passado
                $stmt->bindValue(":cpf", $usuario->__get_cpf());
                $stmt->bindValue(":nome", $usuario->__get_nome());
                $stmt->bindValue(":senha", $usuario->__get_senha());
                $stmt->bindValue(":privilegio", $usuario->__get_privilegio());
                $stmt->execute();
                echo "usuario inserido com sucesso";
            }catch(Exception $e){
                echo "erro ao inserir".$e;
            }
           
        }

        public function pesquisar_todos_usuario(){
            try{
                $sql = "SELECT * FROM usuarios";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao pesquisar usuarios $e";
                return null;
            }
        }

        public function buscar_usuario_pelo_cpf($cpf){
            try{
                $sql = "SELECT * FROM usuarios WHERE cpf = :cpf";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":cpf", $cpf);
                $stmt->execute();
                $dados = $stmt->fetchAll();
                return $dados;
            }catch(Exception $e){
                echo "Erro ao buscar usuario $e";
                return null;
            }
        }

        public function deletar_usuario($id){
            try{
                $sql = "DELETE FROM usuarios WHERE cpf = $id";
                //poderia ter usado bindParam também
                // $stmt = $pdo->prepare('DELETE FROM minhaTabela WHERE id = :id');
                // $stmt->bindParam(':id', $id);
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                echo "Usuario excluido com sucesso";

            }catch(Exception $e){
                echo "Erro ao excluir usuario $e";
            }
        }

        public function atualizar_usuario($usuario){
            try{
                $sql = "UPDATE usuarios SET nome = :nome, senha = :senha, privilegio = :privilegio WHERE cpf = :cpf";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":cpf", $usuario->__get_cpf());
                $stmt->bindValue(":nome", $usuario->__get_nome());
                $stmt->bindValue(":senha", $usuario->__get_senha());
                $stmt->bindValue(":privilegio", $usuario->__get_privilegio());
                $stmt->execute();
                echo "Usuario atualizado com sucesso";
            }catch(Exception $e){
                echo "Erro ao atualizar usuario $e";
            }

        }


       

    }


?>
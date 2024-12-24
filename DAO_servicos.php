<?php

    include('conexao.php');
    include('servicos.php');

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



?>
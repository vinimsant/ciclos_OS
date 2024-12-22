<?php

    include('conexao.php');
    include('clientes.php');

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



?>
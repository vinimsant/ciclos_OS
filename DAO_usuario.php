

<?php

include("conexao.php");
include("usuario.php");
// require_once 'conexao.php';
// require_once 'usuario.php';

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

    // $usuario = new Usuario();
    // $usuario->__set_cpf("1234567890");
    // $usuario->__set_nome("Teste update00");
    // $usuario->__set_privilegio("funcionario");
    // $usuario->__set_senha("1234");
    // $dao = new DAO_Usuario();
    // //$dao->deletar_usuario("1234567893");
    // $dao->atualizar_usuario($usuario);
    // echo "<br>";
    // $dados = $dao->pesquisar_todos_usuario();
    // //print_r($dados);

    // // foreach($dados as $linhas){
    // //     print_r($linhas);
    // //     echo "<br>";
    // //     $nome = $linhas["nome"];
    // //     echo $nome;
    // //     echo "<br>";
    // // }

    // // $dados = $dao->buscar_usuario_pelo_cpf("1234567890");
    // // foreach($dados as $linha){
    // //     print_r($linha);
    // // }
?>
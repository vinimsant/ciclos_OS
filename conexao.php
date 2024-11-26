<?php
    class Conexao{

        private $usuario = "root";
        private $host = "localhost";
        private $senha = "";
        private $banco = "ciclos";
        private $con;

        public function conectar($db="ciclos"){
            $this->con = null;
            $this->banco=$db;
            try{
                $this->con = new PDO("mysql:host={$this->host};dbname={$this->banco}",$this->usuario, $this->senha);
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            }catch(PDOException $e){
                echo "Exeção".$e->getMessage();
            }
            return $this->con;
        }
        
    }



?>
<?php
class Usuario {
    
    private string $cpf;
    private string $nome;
    private string $senha;
    private string $privilegio;

    public function __get_cpf(){
        return $this->cpf;
    }
    public function __get_nome(){
        return $this->nome;
    }
    public function __get_senha(){
        return $this->senha;
    }
    public function __get_privilegio(){
        return $this->privilegio;
    }

    public function __set_cpf($cpf){
        $this->cpf = $cpf;
    }
    public function __set_nome($nome){
        $this->nome = $nome;
    }
    public function __set_senha($senha){
        $this->senha = $senha;
    }
    public function __set_privilegio($privilegio){
        $this->privilegio = $privilegio;
    }

    



}

?>
<?php


class Clientes{
    private $cpf;
    private $nome;
    private $tel;
    private $whatsaap;

    public function __get_cpf(){
        return $this->cpf;
    }

    public function __get_nome(){
        return $this->nome;
    }

    public function __get_tel(){
        return $this->tel;
    }

    public function __get_whatsaap(){
        return $this->whatsaap;
    }

    public function __set_cpf($cpf){
        $this->cpf=$cpf;
    }

    public function __set_nome($nome){
        $this->nome=$nome;
    }

    public function __set_tel($tel){
        $this->tel=$tel;
    }

    public function __set_whatsaap($whatsaap){
        $this->whatsaap=$whatsaap;
    }
}

?>
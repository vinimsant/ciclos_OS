<?php 


    class Objetos{

        private $id;
        private $marca;
        private $modelo;
        private $descricao;
        private $dono;

        //mudandei o get para ser uma unica função passando apenas o nome do parametro desejado
        public function __get($name){
            switch($name){
                case "id":
                    return $this->id;
                    break;
                case "marca":
                    return $this->marca;
                    break;
                case "modelo":
                    return $this->modelo;
                    break;
                case "descricao":
                    return $this->descricao;
                    break;
                case "dono":
                    return $this->dono;
                    break;
            }
        }

        //mudei o set para apenas um set
        public function __set($name, $value){
            switch($name){
                case "id":
                    $this->id = $value;
                    break;
                case "marca":
                    $this->marca = $value;
                    break;
                case "modelo":
                    $this->modelo = $value;
                    break;
                case "descricao":
                    $this->descricao = $value;
                    break;
                case "dono":
                    $this->dono = $value;
                    break;
            }
        }
    }
<?php

    class Servicos{

        private $id_servico;
        private $nome_servico;
        private $descricao_servico;
        private $preco_servico;

        public function __get_id_servico(){
            return $this->id_servico;
        }
        public function __get_nome_servico(){
            return $this->nome_servico;
        }
        public function __get_descricao_servico(){
            return $this->descricao_servico;
        }
        public function __get_preco_servico(){
            return $this->preco_servico;
        }

        public function __set_id_servico($id){
            $this->id_servico = $id;
        }
        public function __set_nome_servico($nome){
            $this->nome_servico = $nome;
        }
        public function __set_descricao_servico($descricao){
            $this->descricao_servico = $descricao;
        }
        public function __set_preco_servico($preco){
            $this->preco_servico = $preco;
        }

    }

?>
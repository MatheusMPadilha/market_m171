<?php

class Categoria {
    private $id;
    private $nome;
    
    public function __construct($id = NULL, $nome = NULL){
    	$this->id = $id;
    	$this->nome = $nome;
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

}

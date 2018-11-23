<?php

class Cliente {
	private $id, $nome, $telefone, $email, $cpf, $senha, $filhos, $cidade, $foto, $sexo, $admin;
    
        function __construct($id = NULL, $nome = NULL, $telefone = NULL, $email = NULL, $cpf = NULL, $senha = NULL, $filhos = NULL, $cidade = NULL, $foto = NULL, $sexo = NULL) {
            $this->id = $id;
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->email = $email;
            $this->cpf = $cpf;
            $this->senha = $senha;
            $this->filhos = $filhos;
            $this->cidade = $cidade;
            $this->foto = $foto;
            $this->sexo = $sexo;
        }

        function getId() {
            return $this->id;
        }

        function getNome() {
            return $this->nome;
        }

        function getTelefone() {
            return $this->telefone;
        }

        function getEmail() {
            return $this->email;
        }

        function getCpf() {
            return $this->cpf;
        }

        function getSenha() {
            return $this->senha;
        }

        function getFilhos() {
            return $this->filhos;
        }

        function getCidade() {
            return $this->cidade;
        }

        function getFoto() {
            return $this->foto;
        }

        function getSexo() {
            return $this->sexo;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNome($nome) {
            $this->nome = $nome;
        }

        function setTelefone($telefone) {
            $this->telefone = $telefone;
        }

        function setEmail($email) {
            $this->email = $email;
        }

        function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        function setSenha($senha) {
            $this->senha = $senha;
        }

        function setFilhos($filhos) {
            $this->filhos = $filhos;
        }

        function setCidade($cidade) {
            $this->cidade = $cidade;
        }

        function setFoto($foto) {
            $this->foto = $foto;
        }

        function setSexo($sexo) {
            $this->sexo = $sexo;
        }

        function getAdmin() {
            return $this->admin;
        }

        function setAdmin($admin) {
            $this->admin = $admin;
        }
        
    }

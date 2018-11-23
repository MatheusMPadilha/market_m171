<?php

class CategoriaDAO {
    public static function inserir($categoria){
    	$sql = "insert into categorias (nome) values ('".$categoria->getNome()."');";
    	Conexao::executar($sql);
    }
    public static function editar($categoria){
    	$sql = "update categorias set nome = '".$categoria->getNome()."' where id = ".$categoria->getId();
    	Conexao::executar($sql);
    }
    public static function excluir($idCategoria){
    	$sql = "delete from categorias where id = ".$idCategoria;
    	Conexao::executar($sql);
    }

    public static function getCategorias(){
    	$sql = "select * from categorias order by nome";
    	$result = Conexao::consultar($sql);
    	$lista = new ArrayObject();
    	if($result != NULL){
    		while(list($_id, $_nome)=mysqli_fetch_row($result)){
    			$categoria = new Categoria();
    			$categoria->setId($_id);
    			$categoria->setNome($_nome);
    			$lista->append($categoria);
    		}
    	}
    	return $lista;
    }
    
    public static function getCategoriasById($id){
    	$sql = "select * from categorias WHERE id = ".$id." order by nome";
    	$result = Conexao::consultar($sql);
        list($_id, $_nome)=mysqli_fetch_row($result);
    			$categoria = new Categoria();
    			$categoria->setId($_id);
    			$categoria->setNome($_nome);
    		return $categoria;
    	}    	
    }


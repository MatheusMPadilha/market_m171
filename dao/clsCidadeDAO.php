<?php

class CidadeDAO {
    public static function inserir($cidade){
    	$sql = "insert into cidades (nome) values ('".$cidade->getNome()."');";
    	Conexao::executar($sql);
    }
    public static function editar($cidade){
    	$sql = "update cidades set nome = '".$cidade->getNome()."' where id = ".$cidade->getId();
    	Conexao::executar($sql);
    }
    public static function excluir($idCidade){
    	$sql = "delete from cidades where id = ".$idCidade;
    	Conexao::executar($sql);
    }

    public static function getCidades(){
    	$sql = "select * from cidades order by nome";
    	$result = Conexao::consultar($sql);
    	$lista = new ArrayObject();
    	if($result != NULL){
    		while(list($_id, $_nome)=mysqli_fetch_row($result)){
    			$cidade = new Cidade();
    			$cidade->setId($_id);
    			$cidade->setNome($_nome);
    			$lista->append($cidade);
    		}
    	}
    	return $lista;
    }
    
    public static function getCidadesById($id){
    	$sql = "select * from cidades WHERE id = ".$id." order by nome";
    	$result = Conexao::consultar($sql);
        list($_id, $_nome)=mysqli_fetch_row($result);
    			$cidade = new Cidade();
    			$cidade->setId($_id);
    			$cidade->setNome($_nome);
    		return $cidade;
    	}

}

<?php

/*
 * market_m171
 */

class ProdutoDAO {
    public static function inserir($produto){
        $sql = "INSERT INTO produtos "
                . " (nome, preco, quantidade, foto, idCategoria) VALUES"
                . " ('".$produto->getNome()."' , "
                . " '".$produto->getPreco()."' , "
                . " '".$produto->getQuantidade()."' , "
                . " '".$produto->getFoto()."' , "
                . " ".$produto->getCategoria()->getId()."  "
                . " ); ";
        Conexao::executar($sql);
    }
    public static function editar($produto){
        $sql = "UPDATE produtos SET "
                . " nome = '".$produto->getNome()."' , "
                . " preco =  ".$produto->getPreco()."  , "
                . " quantidade =  ".$produto->getQuantidade()."  , "
                . " foto = '".$produto->getFoto()."' , "
                . " idCategoria = ".$produto->getCategoria()->getId()."  "
                . " WHERE id = ".$produto->getId();
        Conexao::executar($sql);
    }
    public static function excluir($produto){
        $sql = "delete from produtos where id = ".$produto->getId();
    	Conexao::executar($sql);
    }
    public static function getProdutos(){
        $sql = "SELECT p.id, p.nome, p.preco, p.quantidade, p.foto, c.id, c.nome "
                . "FROM produtos p "
                . "INNER JOIN categorias c ON p.idCategoria = c.id "
                . "ORDER BY p.nome ";
        $result = Conexao::consultar($sql);
    	$lista = new ArrayObject();    	
    	while(list($cod, $nome, $preco, $quan, $foto, $codCat, $nomeCat) = mysqli_fetch_row($result)){
    			$categoria = new Categoria();
    			$categoria->setId($codCat);
    			$categoria->setNome($nomeCat);
                        
                        $produto = new Produto();
                        $produto->setId($cod);
                        $produto->setNome($nome);
                        $produto->setPreco($preco);
                        $produto->setQuantidade($quan);
                        $produto->setFoto($foto);
                        $produto->setCategoria($categoria);
                        
    			$lista->append($produto);
    		}	
    	
    	return $lista;
    
    }
    public static function getProdutosById($id){
        $sql = "SELECT p.id, p.nome, p.preco, p.quantidade, p.foto, c.id, c.nome "
                . " FROM produtos p "
                . " INNER JOIN categorias c ON p.idCategoria = c.id "
                . " WHERE p.id = ".$id
                . " ORDER BY p.nome ";
        $result = Conexao::consultar($sql);   
        
    	list($cod, $nome, $preco, $quan, $foto, $codCat, $nomeCat) = mysqli_fetch_row($result);
    		$categoria = new Categoria();
    		$categoria->setId($codCat);
    		$categoria->setNome($nomeCat);
                        
                $produto = new Produto();
                $produto->setId($cod);
                $produto->setNome($nome);
                $produto->setPreco($preco);
                $produto->setQuantidade($quan);
                $produto->setFoto($foto);
                $produto->setCategoria($categoria);
    	
            return $produto;
    }
    
}

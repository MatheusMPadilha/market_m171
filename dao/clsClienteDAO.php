<?php

class ClienteDAO {
    public static function inserir($cliente){
        $sql = "INSERT INTO clientes "
                . " (nome, telefone, cpf, email, senha, "
                . " foto, idCidade, sexo, filhos, admin) VALUES"
                . " ('".$cliente->getNome()."' , "
                . " '".$cliente->getTelefone()."' , "
                . " '".$cliente->getCpf()."' , "
                . " '".$cliente->getEmail()."' , "
                . " '".$cliente->getSenha()."' , "
                . " '".$cliente->getFoto()."' , "
                . " ".$cliente->getCidade()->getId()." , "
                . " '".$cliente->getSexo()."' , "
                . " ".$cliente->getFilhos()." , "
                . " ".$cliente->getAdmin()."  "
                . " ); ";
        Conexao::executar($sql);
    }
    public static function editar($cliente){
        $sql = "UPDATE clientes SET "
                . " nome = '".$cliente->getNome()."' , "
                . " telefone ='".$cliente->getTelefone()."' , "
                . " cpf ='".$cliente->getCpf()."' , "
                . " email ='".$cliente->getEmail()."' , "
                . " foto ='".$cliente->getFoto()."' , "
                . " idCidade =".$cliente->getCidade()->getId()." , "
                . " sexo ='".$cliente->getSexo()."' , "
                . " filhos =".$cliente->getFilhos()."  , "
                . " admin =".$cliente->getAdmin()
                . " WHERE id = ".$cliente->getId();              
        Conexao::executar($sql);
    }
    public static function excluir($cliente){
        $sql = "delete from clientes where id = ".$cliente->getId();
    	Conexao::executar($sql);
    }
    public static function getClientes(){
    	$sql = "SELECT c.id, c.nome, c.telefone, c.cpf,"
                . " c.email, c.foto, d.id, d.nome, c.sexo, c.filhos, c.admin"
                . " FROM clientes c"
                . " INNER JOIN cidades d ON c.idCidade = d.id"
                . " ORDER BY c.nome ";
    	$result = Conexao::consultar($sql);
    	$lista = new ArrayObject();    	
    	while(list($cod, $nome, $fone, $cpf, $mail, $foto, $codCid, $nomeCid, $sexo, $filhos, $admin) = mysqli_fetch_row($result)){
    			$cidade = new Cidade();
    			$cidade->setId($codCid);
    			$cidade->setNome($nomeCid);
                        
                        $cliente = new Cliente();
                        $cliente->setId($cod);
                        $cliente->setNome($nome);
                        $cliente->setTelefone($fone);
                        $cliente->setEmail($mail);
                        $cliente->setCpf($cpf);
                        $cliente->setFoto($foto);
                        $cliente->setCidade($cidade);
                        $cliente->setSexo($sexo);
                        $cliente->setFilhos($filhos);
                        $cliente->setAdmin($admin);
                        
    			$lista->append($cliente);
    		}	
    	
    	return $lista;
    }
    public static function getClientesById($id){
    	$sql = "SELECT c.id, c.nome, c.telefone, c.cpf,"
                . " c.email, c.foto, d.id, d.nome, c.sexo, c.filhos, c.admin"
                . " FROM clientes c"
                . " INNER JOIN cidades d ON c.idCidade = d.id"
                . " WHERE c.id = ".$id
                . " ORDER BY c.nome ";
    	$result = Conexao::consultar($sql);  	
    	list($cod, $nome, $fone, $cpf, $mail, $foto, $codCid, $nomeCid, $sexo, $filhos, $admin) = mysqli_fetch_row($result);
    		$cidade = new Cidade();
                $cidade->setId($codCid);
    		$cidade->setNome($nomeCid);
                        
                $cliente = new Cliente();
                $cliente->setId($cod);
                $cliente->setNome($nome);
                $cliente->setTelefone($fone);
                $cliente->setEmail($mail);
                $cliente->setCpf($cpf);
                $cliente->setFoto($foto);
                $cliente->setCidade($cidade);
                $cliente->setSexo($sexo);
                $cliente->setFilhos($filhos);
                $cliente->setAdmin($admin);
                        
    	return $cliente;
    }
    
    public static function logar($login, $senha){
        $sql = "SELECT id, nome, foto, admin FROM clientes "
                . "WHERE (email = '".$login."' or CPF = '".$login."') "
                . "and senha = '".$senha."'";
        $result = Conexao::consultar($sql);
        
        if(mysqli_num_rows($result) > 0){
            $dados = mysqli_fetch_assoc($result);
            $cliente = new Cliente();
            $cliente->setId($dados['id']);
            $cliente->setNome($dados['nome']);
            $cliente->setFoto($dados['foto']);
            $cliente->setAdmin($dados['admin']);
            return $cliente;
        }else{
            return NULL;
        }
        
    }
    
}

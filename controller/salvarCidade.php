<?php

include_once '../model/clsCidade.php';
include_once '../dao/clsCidadeDAO.php';
include_once '../dao/clsConexao.php';

if(isset($_REQUEST['inserir'])){
	$cidade = new Cidade();
	$cidade->setNome($_POST['txtNome']);

	CidadeDAO::inserir($cidade);

	header("Location: ../cidades.php");
}

if(isset($_REQUEST['editar'])){
    $id = $_REQUEST['idCidade'];
    $cidade = CidadeDAO::getCidadesById($id)    ;
    $cidade->setNome($_POST['txtNome']);
    
    CidadeDAO::editar($cidade);
    
    header("Location: ../cidades.php");    
}

if(isset($_REQUEST['excluir'])){
    $id = $_REQUEST['idCidade'];
    echo '<br><br><hr><h3>Confirma a exclusão da Cidade </h3> <br><hr>';
            echo '<a href="?confirmaExcluir&idCidade='.$id.'"><button>SIM</button></a> ';
            echo '<a href="../cidades.php"><button>NÃO</button></a>';
}

if(isset($_REQUEST['confirmaExcluir'])){
    $id = $_REQUEST['idCidade'];
    CidadeDAO::excluir($id);
    header("Location: ../cidades.php");
}

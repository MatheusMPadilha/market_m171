<?php

include_once '../model/clsCategoria.php';
include_once '../dao/clsCategoriaDAO.php';
include_once '../dao/clsConexao.php';

if(isset($_REQUEST['inserir'])){
	$categoria = new Categoria();
	$categoria->setNome($_POST['txtNome']);

	CategoriaDAO::inserir($categoria);

	header("Location: ../categorias.php");
}

if(isset($_REQUEST['editar'])){
    $id = $_REQUEST['idCategoria'];
    $categoria = CategoriaDAO::getCategoriasById($id);    
    $categoria->setNome($_POST['txtNome']);
    
    CategoriaDAO::editar($categoria);
    
    header("Location: ../categorias.php");    
}

if(isset($_REQUEST['excluir'])){
    $id = $_REQUEST['idCategoria'];
    echo '<br><br><hr><h3>Confirma a exclusão da Categoria </h3> <br><hr>';
            echo '<a href="?confirmaExcluir&idCategoria='.$id.'"><button>SIM</button></a> ';
            echo '<a href="../categorias.php"><button>NÃO</button></a>';
}

if(isset($_REQUEST['confirmaExcluir'])){
    $id = $_REQUEST['idCategoria'];
    CategoriaDAO::excluir($id);
    header("Location: ../categorias.php");
}
<?php

/*
 * market_m171
 */

include_once 'model/clsCategoria.php';
include_once 'dao/clsCategoriaDAO.php';
include_once 'dao/clsConexao.php';
include_once 'dao/clsProdutoDAO.php';
include_once 'model/clsProduto.php';

$nome = "";
$preco = "";
$quantidade = "";
$idCategoria = 0;
$foto = "sem_foto1.png";
$action = "inserir";

if(isset($_REQUEST['editar'])){
    $id = $_REQUEST['idProduto'];
    $produto = ProdutoDAO::getProdutosById($id);
    $nome = $produto->getNome();
    $preco = $produto->getPreco();
    $quantidade = $produto->getQuantidade();
    $foto = $produto->getFoto();
    $idCategoria = $produto->getCategoria()->getId();
    $action = "editar&idProduto=".$produto->getId();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Market M171 - Cadastrar Produto</title>
    </head>
    <body>
        <?php
        	require_once 'menu.php';
        ?>

        <h1 align="center">Cadastrar Produto</h1>

        <br><br><br>

        <form action="controller/salvarProduto.php?<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
        	<label>Nome: </label>
        	<input type="text" name="txtNome" value="<?php echo $nome; ?>" required /> <br><br>
        	<label>Preço: </label>
        	<input type="text" name="txtPreco" value="<?php echo $preco; ?>" required /> <br><br>
        	<label>Quantidade: </label>
        	<input type="text" name="txtQuantidade" value="<?php echo $quantidade; ?>" required /> <br><br>
                
                <?php 
                if(isset($_REQUEST['editar'])){
                    echo '<img src="fotos_produtos/'.$foto.'" width="50px"/>';
                }
                ?>
                
                <label>Foto: </label>
        	<input type="file" name="foto" /> <br><br>
                                
                <label>Categoria: </label>
                <select name="categoria" >
                    <option value="0">Selecione...</option>
                    <?php
                    $lista = CategoriaDAO::getCategorias();
                    foreach($lista as $categoria){
                        $selecionar = "";
                        if($idCategoria == $categoria->getId()){
                            $selecionar = " selected ";
                        }
                        echo '<option '.$selecionar.' value="'.$categoria->getId().'" >'.$categoria->getNome().'</option>';
                    }
                    ?>
                </select> <br><br>
                
        	<input type="submit" value="Salvar"/>
        	<input type="reset" value="Limpar"/>

        </form>

    </body>
</html>

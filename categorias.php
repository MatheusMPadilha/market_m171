<?php

include_once 'model/clsCategoria.php';
include_once 'dao/clsCategoriaDAO.php';
include_once 'dao/clsConexao.php';

$nome = "";
$action = "inserir";

if(isset($_REQUEST['editar'])){
    $id = $_REQUEST['idCategoria'];
    $categoria = CategoriaDAO::getCategoriasById($id);
    $nome = $categoria->getNome();
    $action = "editar&idCategoria=".$categoria->getId();  
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Market M171 - Categorias</title>
    </head>
    <body>
        
        <?php
        require_once 'menu.php';
        ?>
        
        <br> <br> <br> <br>
        
        <h1 align="center">Categorias</h1>
        
        <br> <br> <br>
        
        <form action="controller/salvarCategoria.php?<?php echo $action; ?>" method="POST">
            <label>Nome: </label>
            <input type="text" name="txtNome" value="<?php echo $nome; ?>"/>
            <input type="submit" value="Salvar"/>
        </form>
        
        <hr>
        
        <?php
        $lista = CategoriaDAO::getCategorias();
        if($lista->count()==0){
            echo '<h2><b>Nenhuma categoria cadastrada!</b></h2>';
        }else{
            
        
        ?>
        
        <table border="1">
            
            <tr>
                <th>Código</th>
                <th>Nome da Categoria</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            
            <?php
                foreach ($lista as $categoria){
                        echo '<tr>
                            <td>'.$categoria->getId().'</td>
                            <td>'.$categoria->getNome().'</td>
                            <td>
                                <a href="?editar&idCategoria='
                                .$categoria->getId().'">
                                <button>Editar</button></a>
                            </td>
                            <td>
                                <a href="controller/salvarCategoria.php?excluir&idCategoria='
                                .$categoria->getId().'">
                                <button>Excluir</button></a>
                            </td>
                         </tr>';
                    }    
            ?>
            
        </table>
        <br><br><br>
        
        <?php
        }
        ?>        
        
    </body>
</html>



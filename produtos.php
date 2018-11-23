<?php
include_once 'model/clsCategoria.php';
include_once 'model/clsProduto.php';
include_once 'dao/clsConexao.php';
include_once 'dao/clsProdutoDAO.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        	require_once'menu.php';
        ?>

        <h1 align="center">Produtos</h1>

        <br><br><br>

        <a href="frmProduto.php">
        	<button>Cadastrar novo produto</button></a>

        <br><br>
        
        <?php
        
        $lista = ProdutoDAO::getProdutos();
        
        if($lista->count() == 0){
            echo '<h3><b>Nenhum produto cadastrado!</b></h3>';
        } else {                 
            
        ?>

        <table border="1">
            
            <tr>
                <th>Código</th>
                <th>Foto</th>
                <th>Nome do Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            
            <?php
                    foreach ($lista as $produto){
                        echo '<tr> ';
                        echo '  <td>'.$produto->getId().'</td>';
                        echo '  <td><img src="fotos_produtos/'.$produto->getFoto().'" width="50px"/></td>';
                        echo '  <td>'.$produto->getNome().'</td>';
                        echo '  <td>'.$produto->getPreco().'</td>';
                        echo '  <td>'.$produto->getQuantidade().'</td>';
                        echo '  <td>'.$produto->getCategoria()->getNome().'</td>';                        
                                                
                        echo '<td><a href="frmProduto.php?editar&idProduto='.$produto->getId().'"><button>Editar</button></a> </td>';
                        echo '<td><a href="controller/salvarProduto.php?excluir&idProduto='.$produto->getId().'"><button>Excluir</button></a> </td>';
                        echo '</tr>';
                    }
            ?>
            
        </table>
        
        <?php
        }
        ?>
        

    </body>
</html>



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
        
        <?php
            if(isset($_SESSION['admin']) && $_SESSION['admin']){
        ?>
        <a href="frmProduto.php">
        	<button>Cadastrar novo produto</button></a>
        <br><br>
        <?php
            }
            
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
                <th>Comprar</th>
            </tr>
            
            <?php
                    foreach ($lista as $produto){
                        echo '<tr> ';
                        echo '  <td>'.$produto->getId().'</td>';
                        echo '  <td><img src="fotos_produtos/'.$produto->getFoto().'" width="30px"/></td>';
                        echo '  <td>'.$produto->getNome().'</td>';
                        $preco = str_replace(".",",",$produto->getPreco());
                        echo '  <td>R$ '.$preco.'</td>';
                        $qtd = str_replace(".",",",$produto->getQuantidade());
                        echo '  <td>'.$qtd.'</td>';
                        echo '  <td>'.$produto->getCategoria()->getNome().'</td>';
                        
                        $desabilita = "";
                        if(!isset($_SESSION['admin']) || !$_SESSION['admin']){
                            $desabilita = " disabled ";
                        }
                                                
                        echo '<td><a href="frmProduto.php?editar&idProduto='.$produto->getId().'"><button '.$desabilita.'>Editar</button></a> </td>';
                        echo '<td><a href="controller/salvarProduto.php?excluir&idProduto='.$produto->getId().'"><button '.$desabilita.'>Excluir</button></a> </td>';
                        echo '<td><a href="carrinho.php?adicionar&idProduto='.$produto->getId().'"><button>Adicionar</button></a> </td>';
                        echo '</tr>';
                    }
            ?>
            
        </table>
        
        <?php
        }
        ?>
        

    </body>
</html>



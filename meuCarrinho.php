<?php
    session_start();
    include_once 'dao/clsConexao.php';
    include_once 'dao/clsProdutoDAO.php';
    include_once 'model/clsCategoria.php';
    include_once 'model/clsProduto.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Market  M171 - Carrinho de Compras</title>
    </head>
    <body>
        <?php
            require_once 'menu.php';
        ?>
        <h1 align="center">Carrinho de Compras</h1>
        <?php
            if(!isset($_SESSION['carrinho']) || count(($_SESSION['carrinho'])) == 0){
                echo '<h3>Seu carrinho está vazio!</h3>';
            }else{
                echo '<table border="1">';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Foto</th>';
                echo '<th>Nome</th>';
                echo '<th>Quantidade</th>';
                echo '<th>Preço</th>';
                echo '<th>Subtotal</th>';
                echo '<th>Remover</th>';
                echo '</tr>';
                
                $total = 0;
                foreach ($_SESSION['carrinho'] as $id => $qtd){
                    $produto = ProdutoDAO::getProdutosById($id);
                    echo '<tr>';
                    echo '<td>'.$produto->getId().'</td>';
                    echo '<td><img width="30px" src="fotos_produtos/'.$produto->getFoto().'"/></td>';
                    echo '<td>'.$produto->getNome().'</td>';
                    echo '<td>'.$qtd.'<a href="carrinho.php?remover&idProduto='.$produto->getId().'"><button>-</button></a> | '
                            . '<a href="carrinho.php?adicionar&idProduto='.$produto->getId().'"><button>+</button></a> | </td>';
                    echo '<td>R$ '.$produto->getPreco().'</td>';
                    $subtotal = $qtd*$produto->getPreco();
                    $total += $subtotal;
                    echo '<td>R$ '.$subtotal.'</td>';
                    echo '<td><a href="carrinho.php?excluir&idProduto='.$produto->getId().'"><button>Excluir</button></a></td>';
                    echo '</tr>';
                }
                echo '<tr> ';
                echo '<th colspan="4">Total: </th>';
                echo '<td colspan="3">R$ '.$total.'</td>';
                echo '</tr> ';
                echo '</table> ';
                
                echo '<hr> <a href="finalizarPedido.php"><button>Finalizar Pedido</button></a>';
            }
        ?>
    </body>
</html>

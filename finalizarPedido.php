<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Market M171 - Finalizar Pedido</title>
    </head>
    <body>
        <?php
        require_once 'menu.php';
        ?>
        
        <br> <br> <br> <br>
        
        <h1 align="center">Finalizar Pedido</h1>
        <?php
            if(isset($_SESSION['logado']) && $_SESSION['logado']){
                ?>
        <form action="controller/salvarPedido.php?inserir" method="POST" >
            <label>Endereço: </label>
            <input type="text" name="txtEndereco" maxlength="100"/>
            <br><br>
            <label>Forma de Pagamento: </label>
            <select name="pagamento">
                <option value="0">Selecione</option>
                <option value="boleto">Boleto</option>
                <option value="credito01">Crédito 1X</option>
                <option value="credito02">Crédito 2X</option>
                <option value="credito03">Crédito 3X</option>
            </select>
            <br><br>
            <input type="submit" value="Finalizar Compra" />
        </form>
                <?php
            }else{
                echo '<h3>Você deve realizar seu Login &uarr;</h3>';
            }
        ?>
        
        <br> <br> <br>
    </body>
</html>

<?php

session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']){

include_once 'model/clsCidade.php';
include_once 'model/clsCliente.php';
include_once 'dao/clsConexao.php';
include_once 'dao/clsClienteDAO.php';
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

        <h1 align="center">Clientes</h1>

        <br><br><br>

        <a href="frmCliente.php">
        	<button>Cadastrar novo cliente</button></a>

        <br><br>
        
        <?php
        
        $lista = ClienteDAO::getClientes();
        
        if($lista->count() == 0){
            echo '<h3><b>Nenhum cliente cadastrado!</b></h3>';
        } else {                 
            
        ?>

        <table border="1">
            
            <tr>
                <th>Código</th>
                <th>Foto</th>
                <th>Nome do Cliente</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Cidade</th>
                <th>Sexo</th>
                <th>Tem filhos</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            
            <?php
                    foreach ($lista as $cli){
                        echo '<tr> ';
                        echo '  <td>'.$cli->getId().'</td>';
                        echo '  <td><img src="fotos_clientes/'.$cli->getFoto().'" width="50px"/></td>';
                        echo '  <td>'.$cli->getNome().'</td>';
                        echo '  <td>'.$cli->getCpf().'</td>';
                        echo '  <td>'.$cli->getTelefone().'</td>';
                        echo '  <td>'.$cli->getEmail().'</td>';
                        echo '  <td>'.$cli->getCidade()->getNome().'</td>';
                        
                        if($cli->getSexo() == "f")
                            echo '  <td>Feminino</td>';
                        else
                            echo '  <td>Masculino</td>';
                        
                        if($cli->getFilhos())
                            echo '  <td>Sim</td>';
                        else
                            echo '  <td>Não</td>';
                        
                        echo '<td><a href="frmCliente.php?editar&idCliente='.$cli->getId().'"><button>Editar</button></a> </td>';
                        echo '<td><a href="controller/salvarCliente.php?excluir&idCliente='.$cli->getId().'"><button>Excluir</button></a> </td>';
                        echo '</tr>';
                    }
            ?>
            
        </table>
        
        <?php
        }
        ?>
        

    </body>
</html>

<?php
    }else{
        header("Location: index.php");
    }
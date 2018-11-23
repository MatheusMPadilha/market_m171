<?php
include_once 'model/clsCidade.php';
include_once 'dao/clsCidadeDAO.php';
include_once 'dao/clsConexao.php';
include_once 'dao/clsClienteDAO.php';
include_once 'model/clsCliente.php';

session_start();

$nome = "";
$telefone = "";
$email = "";
$cpf = "";
$sexo = "";
$filhos = 0;
$admin = 0;
$idCidade = 0;
$foto = "sem_foto.png";
$action = "inserir";

if(isset($_REQUEST['editar'])){
    $id = $_REQUEST['idCliente'];
    $cliente = ClienteDAO::getClientesById($id);
    $nome = $cliente->getNome();
    $telefone = $cliente->getTelefone();
    $email = $cliente->getEmail();
    $cpf = $cliente->getCpf();
    $sexo = $cliente->getSexo();
    $filhos = $cliente->getFilhos();
    $admin = $cliente->getAdmin();
    $foto = $cliente->getFoto();
    $idCidade = $cliente->getCidade()->getId();
    $action = "editar&idCliente=".$cliente->getId();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Market M171 - Cadastrar Cliente</title>
    </head>
    <body>
        <?php
        	require_once 'menu.php';
        ?>

        <h1 align="center">Cadastrar Cliente</h1>

        <br><br><br>

        <form action="controller/salvarCliente.php?<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
        	<label>Nome: </label>
        	<input type="text" name="txtNome" value="<?php echo $nome; ?>" required maxlength="100" /> <br><br>
                
                <?php
                    if(isset($_SESSION['admin']) && $_SESSION['admin']){
                        
                        if($admin){
                            echo '<input type="checkbox" selected name="cbAdmin" />';
                        }else{
                            echo '<input type="checkbox" name="cbAdmin" />';
                        }
                        echo '<label>Admin</label> <br><br>';                
                    }
                ?>        
                
        	<label>Telefone: </label>
        	<input type="text" name="txtTelefone" value="<?php echo $telefone; ?>" required maxlength="20" /> <br><br>
        	<label>E-mail: </label>
        	<input type="email" name="txtEmail" value="<?php echo $email; ?>" required /> <br><br>
                <label>CPF: </label>
        	<input type="text" name="txtCPF" value="<?php echo $cpf; ?>" required /> <br><br>
                
                <label>Cidade: </label>
                <select name="cidade" >
                    <option value="0">Selecione...</option>
                    <?php
                    $lista = CidadeDAO::getCidades();
                    foreach($lista as $cid){
                        $selecionar = "";
                        if($idCidade == $cid->getId()){
                            $selecionar = " selected ";
                        }
                        echo '<option '.$selecionar.' value="'.$cid->getId().'" >'.$cid->getNome().'</option>';
                    }
                    ?>
                </select> <br><br>
                
                <?php
                $masculino = "";
                $feminino = "";
                if($sexo == "f"){
                    $feminino = " checked ";
                }
                if($sexo == "m"){
                    $masculino = " checked ";
                }
                ?>
                
        	<label>Sexo: </label>
                <input type="radio" name="rbSexo" <?php echo $feminino; ?> value="f" required /> Feminino 
        	<input type="radio" name="rbSexo" <?php echo $masculino; ?> value="m" /> Masculino <br><br>
                
                <?php 
                $checado = "";
                if($filhos)
                    $checado = " checked ";                
                ?>

        	<input type="checkbox" name="cbFilhos" <?php echo $checado; ?> /> Tem Filhos <br><br>

        	<label>Foto: </label>
                
                <?php 
                if(isset($_REQUEST['editar'])){
                    echo '<img src="fotos_clientes/'.$foto.'" width="50px"/>';
                }
                ?>
                
        	<input type="file" name="foto" /> <br><br>
                <?php
                if(!isset($_REQUEST['editar'])){
                ?>
        	<label>Senha: </label>
        	<input type="password" name="txtSenha" required maxlength="100" /> <br><br>
        	<label>Confirme sua senha: </label>
        	<input type="password" name="txtSenhaConfirma" required maxlength="100" /> <br><br><br>
                <?php } ?>

        	<input type="submit" value="Salvar"/>
        	<input type="reset" value="Limpar"/>

        </form>

    </body>
</html>

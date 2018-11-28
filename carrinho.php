<?php

session_start();

$id = $_REQUEST['idProduto'];

if(isset($_REQUEST['adicionar'])){
    if(isset($_SESSION['carrinho'][$id])){
        $_SESSION['carrinho'][$id]++;
    }else{
        $_SESSION['carrinho'][$id] = 1;
    }
}
if(isset($_REQUEST['remover'])){
    if(isset($_SESSION['carrinho'])){
        if($_SESSION['carrinho'][$id] > 1){
            $_SESSION['carrinho'][$id] --;
        }else{
            unset($_SESSION['carrinho'][$id]);
        }
    }
}
if(isset($_REQUEST['excluir'])){
    if(isset($_SESSION['carrinho'][$id])){
        unset($_SESSION['carrinho'][$id]);
    }
}

header("Location: meuCarrinho.php");
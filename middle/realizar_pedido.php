<?php
session_start();
include_once("./componentes/pedido.php");
include_once("./conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $pedido = new Pedido();
    $pedido->conn = $conn;
    $pedido->idusuario = $_SESSION['idusuario'];
    $pedido->idproduto = $_POST['idproduto'];
    $pedido->frete = $_POST['frete'];
    $pedido->total = $_POST['total'];
    $pedido->taxas = $_POST['taxas'];
    $pedido->idformapagamento = $_POST['idformapagamento'];
    $pedido->idpedidostatus = $_POST['idpedidostatus'];
    $pedido->data = $_POST['data'];

    if ($pedido->InsertPedido()) {
        echo "<script>
            alert('Pedido realizado com sucesso!');
            window.location.href = 'pedido.paciente.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao realizar pedido!');
            window.location.href = 'pedido.paciente.php';
        </script>";
    }
    exit;
} else {
    header('Location: pedido.paciente.php');
}
?>
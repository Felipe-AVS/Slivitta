<?php
session_start();
require_once("./conexao.php");
require_once 'Pedido.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$idpedido = isset($_POST['idpedido']) ? intval($_POST['idpedido']) : 0;
$idpedidostatus = isset($_POST['idpedidostatus']) ? intval($_POST['idpedidostatus']) : 0;

if ($idpedido <= 0 || $idpedidostatus <= 0) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
    exit;
}

// Método direto - atualiza apenas o status
$pedidoComp = new Pedido();
$pedidoComp->conn = $conn;

// Busca o pedido atual
$pedidoComp->idpedido = $idpedido;
$pedidoAtual = $pedidoComp->SelectPedido();

if (empty($pedidoAtual)) {
    echo json_encode(['success' => false, 'message' => 'Pedido não encontrado']);
    exit;
}

// Atualiza apenas o status usando UPDATE direto
$sql = "UPDATE pedido SET idpedidostatus = ? WHERE idpedido = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Erro ao preparar query']);
    exit;
}

mysqli_stmt_bind_param($stmt, "ii", $idpedidostatus, $idpedido);
$result = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Status atualizado com sucesso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar status']);
}
?>
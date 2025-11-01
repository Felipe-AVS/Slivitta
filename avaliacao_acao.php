<?php
session_start();
include_once("./conexao.php");
include_once("./componentes/avaliacao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['idavaliacao']);
  $acao = $_POST['acao'] ?? '';

  if (!$id || !in_array($acao, ['aprovar', 'recusar'])) {
    header("Location: dashboard.avaliacoes.php?erro=acao_invalida");
    exit;
  }

  $status = $acao === 'aprovar' ? 1 : 2;

  $sql = "UPDATE avaliacao SET statusavaliacao = ? WHERE idavaliacao = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ii", $status, $id);
  mysqli_stmt_execute($stmt);

  header("Location: dashboard.avaliacoes.php?sucesso=$acao");
  exit;
}

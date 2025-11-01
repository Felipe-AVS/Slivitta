<?php
include_once("./conexao.php");
include_once("./componentes/avaliacao.php");

header('Content-Type: application/json');

if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo json_encode(["sucesso" => false, "erro" => "ID não informado"]);
  exit;
}

$idavaliacao = intval($_GET['id']);

$avaliacao = new Avaliacao();
$avaliacao->conn = $conn;
$avaliacao->idavaliacao = $idavaliacao;

$result = $avaliacao->SelectAvaliacao();

if ($result && count($result) > 0) {
  echo json_encode(["sucesso" => true, "avaliacao" => $result[0]]);
} else {
  echo json_encode(["sucesso" => false, "erro" => "Avaliação não encontrada"]);
}

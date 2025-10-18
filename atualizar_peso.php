<?php
session_start();
require_once("./conexao.php");
require_once './componentes/usuario.php'; // Inclua a classe Usuario

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['peso'])) {

    $user = new Usuario();
    $user->conn = $conn;
    $user->idusuario = $_SESSION['idusuario'];

    // Primeiro busca o usuário atual para preencher todos os dados
    $user->SelectUsuario();

    // Atualiza apenas o peso
    $user->peso = $_POST['peso'];

    // Salva no banco
    if ($user->InsertUsuario()) {
        $_SESSION['peso'] = $user->peso;
        echo "<script>window.location.href='./dados.paciente.php'</script>";
    } else {
        echo "<script>window.location.href='./dados.paciente.php'</script>";
    }
    exit;
}
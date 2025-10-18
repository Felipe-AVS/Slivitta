<?php
session_start();
require_once("./conexao.php");
require_once './componentes/usuario.php'; // Inclua a classe Usuario

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['altura'])) {

    $user = new Usuario();
    $user->conn = $conn;
    $user->idusuario = $_SESSION['idusuario'];

    // Primeiro busca o usuário atual para preencher todos os dados
    $user->SelectUsuario();

    // Atualiza apenas o peso
    $user->altura = $_POST['altura'];

    // Salva no banco
    if ($user->InsertUsuario()) {
        $_SESSION['altura'] = $user->altura;
        echo "<script>window.location.href='./dados.paciente.php'</script>";
    } else {
        echo "<script>window.location.href='./dados.paciente.php'</script>";
    }

    exit;
}

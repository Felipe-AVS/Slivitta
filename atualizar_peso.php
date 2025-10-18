<?php
session_start();
require_once("./conexao.php");
require_once './componentes/usuario.php';
require_once './componentes/progresso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['peso'])) {

    $user = new Usuario();
    $user->conn = $conn;
    $user->idusuario = $_SESSION['idusuario'];

    $progresso = new Progresso();
    $progresso->conn = $conn;
    $progresso->idusuario = $_SESSION['idusuario'];



    // Primeiro busca o usuário atual para preencher todos os dados
    $user->SelectUsuario();

    $progresso->diferencapeso = $_POST['peso'] - $user->peso;
    $progresso->diferencaaltura = $user->altura;
    $progresso->InsertProgresso();

    $_SESSION['difpeso'] = $progresso->CalcularPerdaPesoTotal();

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

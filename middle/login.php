<?php
session_start();
include_once("../conexao.php");
include_once("../componentes/usuario.php");

$user = new Usuario();
$user->conn = $conn;
$user->celular = $_POST['celular'];
$user->senha = $_POST['senha'];

if ($user->LogarUsuario()) {
    echo "<script>alert('Login realizado com sucesso!');</script>";
    switch($_SESSION["idcategoria"]) {
        case 1 :
            echo "<script>window.location.href='../dashboard.paciente.php'</script>";
            break;
        case 2:
            echo "<script>window.location.href='../dashboard.php'</script>";
            break;
        }
} else {
    echo "<script>alert('Celular ou senha incorretos!');</script>";
    echo "<script>window.location.href='../login.php'</script>";
}
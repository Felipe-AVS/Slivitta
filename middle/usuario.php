<?php

include_once("../conexao.php");
include_once("../componentes/usuario.php");

    $user = new Usuario();
    $user->conn = $conn;
    $user->idusuario = "";
    $user->idcategoria = "1";
    $user->nome = $_POST['nome'];
    $user->email = $_POST['email'];
    $user->celular = $_POST['celular'];
    $user->senha = $_POST['senha'];

    $user->InsertUsuario();


    echo "<script>window.location.href='../login.php'</script>";

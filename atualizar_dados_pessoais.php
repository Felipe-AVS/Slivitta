<?php
session_start();
require_once("./conexao.php");
require_once './componentes/usuario.php'; // Inclua a classe Usuario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = new Usuario();
    $user->conn = $conn;
    $user->idusuario = $_SESSION['idusuario'];

    // Busca o usuário atual primeiro
    $user->SelectUsuario();

    // Atualiza os dados com os valores do formulário
    $user->nome = $_POST['nome'];
    $user->cpf = $_POST['cpf'];
    $user->celular = $_POST['celular'];
    $user->datanascimento = $_POST['datanascimento'];
    $user->genero = $_POST['genero'];
    $user->endereco = $_POST['endereco'];
    $user->numero = $_POST['numero'];
    $user->bairro = $_POST['bairro'];
    $user->cidade = $_POST['cidade'];

    // Salva no banco
    if ($user->InsertUsuario()) {
        // Atualiza a sessão
        $_SESSION['nome'] = $user->nome;
        $_SESSION['cpf'] = $user->cpf;
        $_SESSION['celular'] = $user->celular;
        $_SESSION['datanascimento'] = $user->datanascimento;
        $_SESSION['genero'] = $user->genero;
        $_SESSION['endereco'] = $user->endereco;
        $_SESSION['numero'] = $user->numero;
        $_SESSION['bairro'] = $user->bairro;
        $_SESSION['cidade'] = $user->cidade;

        echo "<script>window.location.href='./dados.paciente.php'</script>";
    } else {
        echo "<script>window.location.href='./dados.paciente.php'</script>";
    }
    exit;
}

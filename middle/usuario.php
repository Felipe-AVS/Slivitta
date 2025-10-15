<?php

include_once("../conexao.php");
include_once("../componentes/usuario.php");
include_once("../componentes/avaliacao.php");

    $user = new Usuario();
    $user->conn = $conn;
    $user->idusuario = "";
    $user->idcategoria = "1";
    $user->nome = $_POST['nome'];
    $user->cpf = $_POST['cpf'];
    $user->celular = $_POST['celular'];
    $user->endereco = $_POST['endereco'];
    $user->numero = $_POST['numero'];
    $user->bairro = $_POST['bairro'];
    $user->cidade = $_POST['cidade'];
    $user->senha = $_POST['senha'];
    $user->datanascimento = $_POST['datanascimento'];
    $user->genero = $_POST['genero'];
    $user->peso = $_POST['peso'];
    $user->altura = $_POST['altura'];

    $user->InsertUsuario();

    $idUser = $user->idusuario;

    $avalicao = new Avaliacao();
    $avalicao->conn = $conn;
    $avalicao->idusuario = $idUser;
    $avalicao->diabetes = $_POST['diabetes'];
    $avalicao->pressaoalta = $_POST['pressaoalta'];
    $avalicao->colesterol = $_POST['colesterol'];
    $avalicao->problemasCardiacos = $_POST['problemasCardiacos'];
    $avalicao->frequenciaAtividadeFisica = $_POST['frequenciaAtividadeFisica'];
    $avalicao->alimentacao = $_POST['alimentacao'];
    $avalicao->horasSono = $_POST['horasSono'];
    $avalicao->fuma = $_POST['fuma'];
    $avalicao->medicamentos = $_POST['medicamentos'];
    $avalicao->alergias = $_POST['alergias'];
    $avalicao->cirurgias = $_POST['cirurgias'];
    $avalicao->principalObjetivo = $_POST['principalObjetivo'];
    $avalicao->metaPeso = $_POST['metaPeso'];
    $avalicao->outrosTratamentos = $_POST['outrosTratamentos'];
    $avalicao->InsertAvaliacao();


    //echo "<script>window.location.href='../login.php'</script>";

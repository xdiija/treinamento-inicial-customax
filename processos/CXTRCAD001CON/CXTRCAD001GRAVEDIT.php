<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();

include('../../Connections/connpdo.php');
include('../../classes/ClassUsuarios.php');



$id_usuario = $_POST['id_editar'];
$nome_usuario = $_POST['nome'];
$perfil_usuario = $_POST['perfil'];
$email_usuario = $_POST['email'];
$telefone_usuario = $_POST['telefone'];
$rua_usuario = $_POST['rua'];
$numero_usuario = $_POST['numero'];
$bairro_usuario = $_POST['bairro'];
$complemento_usuario = $_POST['complemento'];
$cidade_usuario = $_POST['cidade'];
$estado_usuario = $_POST['estado'];
$nasc_usuarioBr = $_POST['nascimento'];
$exp_data = explode('/', $nasc_usuarioBr);
$nasc_usuarioUs = $exp_data[2] . "-" . $exp_data[1] . "-" . $exp_data[0];
$cpf_usuario = $_POST['cpf'];

Usuarios::grav_edit($conn, $id_usuario, $nome_usuario, $perfil_usuario, $email_usuario, $telefone_usuario, $rua_usuario, $numero_usuario, $bairro_usuario, $complemento_usuario, $cidade_usuario, $estado_usuario, $nasc_usuarioUs, $cpf_usuario);



/*
$update = $conn->prepare("
    UPDATE usuarios SET
    nome_usuario = '$nome_usuario',
    perfil_usuario = '$perfil_usuario',
    email_usuario = '$email_usuario',
    telefone_usuario = '$telefone_usuario',
    rua_usuario = '$rua_usuario',
    bairro_usuario = '$bairro_usuario',
    numero_usuario = '$numero_usuario',
    complemento_usuario = '$complemento_usuario',
    cidade_usuario = '$cidade_usuario',
    estado_usuario = '$estado_usuario',
    cpf_usuario = '$cpf_usuario',
    nasc_usuario = '$nasc_usuarioUs'


    WHERE id_usuario = '$id_usuario'
    ");

    try {
        $execucao = $update->execute();
    } catch (PDOException $e) {
        $execucao = $e->getMessage();
    }


    echo $execucao;
*/

?>
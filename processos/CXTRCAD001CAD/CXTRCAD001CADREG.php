<?php
    include('../../Connections/connpdo.php');
    include('../../classes/ClassUsuarios.php');

    
    $resposta = ['ok' => false, 'msg' => ''];

    $nome_usuario = $_POST['nome'];
    $login_usuario = $_POST['login'];
    $senha_usuario = $_POST['senha'];
    $confirm_senha = $_POST['confirm_senha'];
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
    $status_usuario = 1;

    $cadastro = Usuarios::cadastrar($conn, $nome_usuario, $login_usuario, $senha_usuario, $confirm_senha, $perfil_usuario, $email_usuario, $telefone_usuario, $rua_usuario, $numero_usuario, $bairro_usuario, $complemento_usuario, $cidade_usuario, $estado_usuario, $nasc_usuarioUs, $cpf_usuario, $status_usuario);


    /*
    if(filter_var($email_usuario, FILTER_VALIDATE_EMAIL) == true) {
        $email_valido = true;
    } else {
        $email_valido = false;  
    }

    function validaCPF($cpf) { 
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
    
    $cpfValido = validaCPF($cpf_usuario);


    try {
        $valida_cpf = $conn->prepare(
            "SELECT
            *
            FROM
                usuarios
            WHERE
                cpf_usuario = :cpf_usuario"

        );
        $valida_cpf->bindParam(':cpf_usuario', $cpf_usuario);
        $valida_cpf->execute();

        $valida_email = $conn->prepare(
            "SELECT
            *
            FROM
                usuarios
            WHERE
            email_usuario = :email_usuario"

        );
        $valida_email->bindParam(':email_usuario', $email_usuario);
        $valida_email->execute();

        $valida_login = $conn->prepare(
            "SELECT
            *
            FROM
                usuarios
            WHERE
            login_usuario = :login_usuario"

        );
        $valida_login->bindParam(':login_usuario', $login_usuario);
        $valida_login->execute();

        if($valida_cpf->rowCount() > 0) {
            throw new Exception('Já existe um cliente com este CPF!');
        }

        if($valida_email->rowCount() > 0) {
            throw new Exception('Já existe um cliente com este Email!');
        }

        if($valida_login->rowCount() > 0) {
            throw new Exception('Já existe um cliente com este Login!');
        }

        if($cpfValido == false) {
            throw new Exception('CPF inválido');
        }

        if($email_valido == false) {
            throw new Exception('Email inválido');
        }

        if($senha_usuario != $confirm_senha) {
            throw new Exception('As senhas não combinam');
        }

        $uppercase = preg_match('@[A-Z]@', $senha_usuario);
        $lowercase = preg_match('@[a-z]@', $senha_usuario);
        $number    = preg_match('@[0-9]@', $senha_usuario);
        $specialChars = preg_match('@[^\w]@', $senha_usuario);
    
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($senha_usuario) < 8) {
            throw new Exception('A senha deve ter pelo menos 8 caracteres, deve incluir pelo menos uma letra maiúscula, um número, e um caractere especial!');
        }

        $senha_crip = md5($senha_usuario);

        $insert = $conn->prepare(
            "INSERT INTO 
            usuarios
            (login_usuario, senha_usuario, nome_usuario, cpf_usuario, email_usuario, status_usuario, perfil_usuario, telefone_usuario, rua_usuario, numero_usuario, bairro_usuario, complemento_usuario, cidade_usuario, estado_usuario, nasc_usuario)
            VALUES
            (:login_usuario, :senha_crip, :nome_usuario,:cpf_usuario,:email_usuario, :status_usuario, :perfil_usuario, :telefone_usuario, :rua_usuario, :numero_usuario, :bairro_usuario, :complemento_usuario, :cidade_usuario, :estado_usuario, :nasc_usuarioUs)"
        );

        $insert->bindParam(':login_usuario', $login_usuario);
        $insert->bindParam(':senha_crip', $senha_crip);
        $insert->bindParam(':nome_usuario', $nome_usuario);
        $insert->bindParam(':cpf_usuario', $cpf_usuario);
        $insert->bindParam(':email_usuario', $email_usuario);
        $insert->bindParam(':status_usuario', $status_usuario);
        $insert->bindParam(':perfil_usuario', $perfil_usuario);
        $insert->bindParam(':telefone_usuario', $telefone_usuario);
        $insert->bindParam(':rua_usuario', $rua_usuario);
        $insert->bindParam(':numero_usuario', $numero_usuario);
        $insert->bindParam(':bairro_usuario', $bairro_usuario);
        $insert->bindParam(':complemento_usuario', $complemento_usuario);
        $insert->bindParam(':cidade_usuario', $cidade_usuario);
        $insert->bindParam(':estado_usuario', $estado_usuario);
        $insert->bindParam(':nasc_usuarioUs', $nasc_usuarioUs);
        
        $resposta['ok'] = true;
        $resposta['msg'] = "Cliente salvo com sucesso";
        $insert->execute();

    } catch (Exception $e) {

        $resposta['msg'] = $e->getMessage();
    }
    echo json_encode($resposta);*/
?>
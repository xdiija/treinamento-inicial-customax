<?php
    class Usuarios {

        public static function listar($conn, $filtro_perfil, $filtro_status, $filtro_inicio, $filtro_fim) {
            
            if($filtro_inicio) {
                $exp_inicio = explode("/", $filtro_inicio);
                $filtro_inicioUS = $exp_inicio[2] . "-" . $exp_inicio[1] . "-" . $exp_inicio[0];
                $where_inicio = " AND data_cadastro_usuario >= '$filtro_inicioUS'";
                $possui_inicio = 1;
            } else {
                $where_inicio = "";
                $possui_inicio = 0;
            }

            if($filtro_fim) {
                $exp_fim = explode("/", $filtro_fim);
                $filtro_fimUS = $exp_fim[2] . "-" . $exp_fim[1] . "-" . $exp_fim[0];
                $where_fim = " AND data_cadastro_usuario <= '$filtro_fimUS'";
                $possui_fim = 1;
            } else {
                $where_fim = "";
                $possui_fim = 0;
            }

            if(($possui_inicio == 1) && ($possui_fim == 1)) {
                if(strtotime($filtro_inicioUS) > strtotime($filtro_fimUS)) {
                    echo "0_Filtro Início Maior que Filtro Fim!";
                    return false;
                }
            }

            if($filtro_status) {
                $where_status = "WHERE status_usuario = $filtro_status";
            } else {
                $where_status = "WHERE status_usuario IN (0, 1)";   
            }

            if($filtro_perfil) {
                $where_perfil = " AND perfil_usuario = $filtro_perfil";
            } else {
                $where_perfil = "";   
            }

            $dados = array();

            $busca = $conn->prepare("
                SELECT * FROM usuarios
                INNER JOIN perfis ON (usuarios.perfil_usuario = perfis.id_perfil)
                $where_status
                $where_perfil
                $where_inicio
                $where_fim
            ");

            try {
                $busca->execute();
            } catch (PDOException $e) {
                $e->getMessage();
            }

            while ($row = $busca->fetch(PDO::FETCH_ASSOC)) {
                
                $status_usuario = $row['status_usuario'];

                if($status_usuario == 1) {
                    $nome_status = "Ativo";
                    $cor_status = "green";
                } else {
                    $nome_status = "Inativo";
                    $cor_status = "red";    
                }

                $dadosBuscaRow = array(
                    'id_usuario' => $row['id_usuario'],
                    'nome_usuario' => $row['nome_usuario'],
                    'status_usuario' => $row['status_usuario'],
                    'nome_perfil' => $row['nome_perfil'],
                    'bairro_usuario' => $row['bairro_usuario'],
                    'rua_usuario' => $row['rua_usuario'],
                    'numero_usuario' => $row['numero_usuario'],
                    'cpf_usuario' => $row['cpf_usuario'],
                    'complemento_usuario' => $row['complemento_usuario'],
                    'cidade_usuario' => $row['cidade_usuario'],
                    'estado_usuario' => $row['estado_usuario'],
                    'telefone_usuario' => $row['telefone_usuario'],
                    'email_usuario' => $row['email_usuario'],
                    'nasc_usuario' => $row['nasc_usuario'],
                    'nome_status' => $nome_status,
                    'cor_status' => $cor_status
                );
    
                array_push($dados, $dadosBuscaRow);
            }

            return $dados;
        }

        public static function cadastrar($conn, $nome_usuario, $login_usuario, $senha_usuario, $confirm_senha, $perfil_usuario, $email_usuario, $telefone_usuario, $rua_usuario, $numero_usuario, $bairro_usuario, $complemento_usuario, $cidade_usuario, $estado_usuario, $nasc_usuarioUs, $cpf_usuario, $status_usuario) {
          
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
            echo json_encode($resposta);
            return $resposta;
        }

        public static function edit($conn, $id_usuario) {
            $dados = array();
            //busca dos dados do usuario pelo id no banco de dados
            $busca = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = $id_usuario");
            //tenta executar a busca
            try {
                $busca->execute();
            } catch (PDOException $e) {
                $e->getMessage();
            }
            //salva os dados da busca no array associativo row
            $row = $busca->fetch(PDO::FETCH_ASSOC);

                $dadosBuscaRow = array(
                'nome_usuario' => $row['nome_usuario'],
                'perfil_usuario' => $row['perfil_usuario'],
                'email_usuario' => $row['email_usuario'],
                'telefone_usuario' => $row['telefone_usuario'],
                'rua_usuario' => $row['rua_usuario'],
                'numero_usuario' => $row['numero_usuario'],
                'bairro_usuario' => $row['bairro_usuario'],
                'complemento_usuario' => $row['complemento_usuario'],
                'cidade_usuario' => $row['cidade_usuario'],
                'estado_usuario' => $row['estado_usuario'],
                'nasc_usuarioUs' => $row['nasc_usuario'],
                'nasc_usuarioBr' => date("d/m/Y", strtotime('nasc_usuarioUs')),
                'cpf_usuario' => $row['cpf_usuario']
                );
                array_push($dados, $dadosBuscaRow);
                return $dados;
        }

        public static function grav_edit($conn, $id_usuario, $nome_usuario, $perfil_usuario, $email_usuario, $telefone_usuario, $rua_usuario, $numero_usuario, $bairro_usuario, $complemento_usuario, $cidade_usuario, $estado_usuario, $nasc_usuarioUs, $cpf_usuario) {

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
        }

        public static function status($conn, $id_usuario) {
            $query = $conn->prepare("SELECT status_usuario FROM usuarios WHERE id_usuario = :id_usuario");
            $query->bindParam(':id_usuario', $id_usuario);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);
            $status = $row['status_usuario'];
            $novo_status = $status ? 0 : 1;

            $update = $conn->prepare("UPDATE usuarios SET status_usuario = :status_usuario WHERE id_usuario = :id_usuario");
            $update->bindParam(':status_usuario', $novo_status);
            $update->bindParam(':id_usuario', $id_usuario);
            $update->execute();
        }

        public static function busca_foto($conn, $id_usuario) {
            
            $busca = $conn->prepare("SELECT foto_usuario FROM usuarios WHERE id_usuario = $id_usuario");

            try {
                $busca->execute();
            } catch (PDOException $e) {
                $e->getMessage();
            }

            $row = $busca->fetch(PDO::FETCH_ASSOC);

                $foto_usuario = $row['foto_usuario'];

            return $foto_usuario;
        }

        public static function grava_foto($conn, $id_usuario, $pasta, $pasta_bd, $nome_arquivo, $files) {
            

            if (isset($files['file']) AND ($files['file']['size'] > 0)) {

                $is_file = 1;
                $verifica_extensao = 0;
                $temporary = explode(".", $files['file']['name']);
                $file_extension = end($temporary);
            
                if ($file_extension != "jpg" && $file_extension != "jpeg" && $file_extension != "JPG" && $file_extension != "JPEG" && $file_extension != "png" && $file_extension != "PNG") {
                    $verifica_extensao = 1;
                }
            
                if ($verifica_extensao == 1) {
                    $msg = "Insira imagens do tipo JPG ou PNG!";
                    echo "0_" . $msg;
                    return false;
                }
                else {
            
                    $arquivo_temporario = $files['file']['tmp_name'];
                    $extensao = pathinfo($files['file']['name'], PATHINFO_EXTENSION);
                    $caminho_destino = $pasta . $nome_arquivo . "." . $extensao;
            
                    if (move_uploaded_file($arquivo_temporario, $caminho_destino)) {
                        
                        $caminho_bd = $pasta_bd . $nome_arquivo . "." . $extensao;
                        
                        $busca_foto = $conn->prepare("
                            SELECT foto_usuario FROM usuarios WHERE id_usuario = $id_usuario;
                        ");
                        try {
                            $busca_foto->execute();
                        } catch (PDOException $e) {
                            $e->getMessage();
                        }
            
                        $row_foto = $busca_foto->fetch(PDO::FETCH_ASSOC);
                        $caminho_foto = $row_foto['foto_usuario'];
                        
                        if($caminho_foto) {
                            $exp = explode(".", $caminho_foto);
                            $extensao_bd = $exp[1];
                        } else {
                            $extensao_bd = $extensao;
                            $caminho_foto = false;
                        }
            
                        if($caminho_foto == false || $extensao_bd != $extensao) {
                            
                            if($extensao_bd != $extensao) {
                                unlink("../../" . $caminho_foto);
                            }
            
                            $grava_foto = $conn->prepare("
                                UPDATE usuarios SET foto_usuario = '$caminho_bd' WHERE id_usuario = $id_usuario;
                            ");
                            try {
                                $gravacao_foto = $grava_foto->execute();
                            } catch (PDOException $e) {
                                $gravacao_foto = $e->getMessage();
                            }
                            return $gravacao_foto;
                        }
                        echo 1 . "_?_" . $caminho_bd;
                    }
                    else {
                        //tratativa de erro de mover o arquivo
                        echo "0_?_" . $files['file']['name'] . " não carregado!";
                    }
                }
            }
            else {
                var_dump($files);
                echo "0_?_Não existe arquivos carregados!";
            }
        }
        

    }
?>
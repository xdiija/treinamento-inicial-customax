<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();


include('../../Connections/connpdo.php');
include('../../classes/ClassUsuarios.php');


$user = $_SESSION['id_usuario'];
$perfil = $_SESSION['perfil_usuario'];


$filtro_perfil = $_POST['filtro_perfil'];
$filtro_status = $_POST['filtro_status'];
$filtro_inicio = $_POST['filtro_inicio'];
$filtro_fim = $_POST['filtro_fim'];


$busca = Usuarios::listar($conn, $filtro_perfil, $filtro_status, $filtro_inicio, $filtro_fim);


/*
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
*/


?>
<table id="tab_grid" class="table table-striped table-bordered" style="width:100vh">
    <thead>
        <tr>
            <th>
                <center>#</center>
            </th>
            <th>
                <center>Código</center>
            </th>
            <th>
                <center>Nome</center>
            </th>
            <th>
                <center>Perfil</center>
            </th>
            <th>
                <center>CPF</center>
            </th>
            <th>
                <center>Telefone</center>
            </th>
            <th>
                <center>Email</center>
            </th>
            <th>
                <center>Rua</center>
            </th>
            <th>
                <center>Numero</center>
            </th>
            <th>
                <center>Cidade</center>
            </th>
            <th>
                <center>Bairro</center>
            </th>
            <th>
                <center>Complemento</center>
            </th>
            <th>
                <center>Nascimento</center>
            </th>

        </tr>
    </thead>
    <tbody>
        <?php

            $qtd_registros = count($busca);

            for($i = 0; $i < $qtd_registros; $i++) {

                ?>
                    <tr>
                        <td>
                            <button id="<?php echo $busca[$i]['id_usuario']; ?>" type="button" class="btn btn-danger btnDesativar btn-sm">
                                <i class="fa fa-close"></i>
                            </button>
                            <button id="<?php echo $busca[$i]['id_usuario']; ?>" type="button" class="btn btn-warning btnEditar btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button id="<?php echo $busca[$i]['id_usuario']; ?>" type="button" class="btn btn-info btnFoto btn-sm">
                                <i class="fa fa-camera"></i>
                            </button>
                        </td>
                        <td><?php echo $busca[$i]['id_usuario'] ?></td>
                        <td><?php echo $busca[$i]['nome_usuario'] ?></td>
                        <td><?php echo $busca[$i]['nome_perfil'] ?></td>
                        <td><?php echo $busca[$i]['cpf_usuario'] ?></td>
                        <td><?php echo $busca[$i]['telefone_usuario'] ?></td>
                        <td><?php echo $busca[$i]['email_usuario'] ?></td>
                        <td><?php echo $busca[$i]['rua_usuario'] ?></td>
                        <td><?php echo $busca[$i]['numero_usuario'] ?></td>
                        <td><?php echo $busca[$i]['cidade_usuario'] ?></td>
                        <td><?php echo $busca[$i]['bairro_usuario'] ?></td>
                        <td><?php echo $busca[$i]['complemento_usuario'] ?></td>
                        <td><?php echo $busca[$i]['nasc_usuario'] ?></td>
                        <td>
                            <b>
                                <font color ="<?php echo $busca[$i]['cor_status'] ?>">
                                    <?php echo $busca[$i]['nome_status'] ?>
                                </font>
                            </b>
                        </td>
                    </tr>
                <?php
            }
            /*
            while ($row = $busca->fetch(PDO::FETCH_ASSOC)) {
                $id_usuario = $row['id_usuario'];
                $nome_usuario = $row['nome_usuario'];
                $status_usuario = $row['status_usuario'];
                $nome_perfil = $row['nome_perfil'];
                $bairro_usuario = $row['bairro_usuario'];
                $rua_usuario = $row['rua_usuario'];
                $numero_usuario = $row['numero_usuario'];
                $cpf_usuario = $row['cpf_usuario'];
                $complemento_usuario = $row['complemento_usuario'];
                $cidade_usuario = $row['cidade_usuario'];
                $estado_usuario = $row['estado_usuario'];
                $telefone_usuario = $row['telefone_usuario'];
                $email_usuario = $row['email_usuario'];
                $nasc_usuario = $row['nasc_usuario'];



                if($status_usuario == 1) {
                    $nome_status = "Ativo";
                    $cor_status = "green";
                } else {
                    $nome_status = "Inativo";
                    $cor_status = "red";    
                }
                
                    
                ?>
                <tr>
                    <td>
                        <button id="<?php echo $id_usuario; ?>" type="button" class="btn btn-danger btnDesativar btn-sm">
                            <i class="fa fa-close"></i>
                        </button>
                        <button id="<?php echo $id_usuario; ?>" type="button" class="btn btn-warning btnEditar btn-sm">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button id="<?php echo $id_usuario; ?>" type="button" class="btn btn-info btnFoto btn-sm">
                            <i class="fa fa-camera"></i>
                        </button>
                    </td>
                    <td><?php echo $id_usuario ?></td>
                    <td><?php echo $nome_usuario ?></td>
                    <td><?php echo $nome_perfil ?></td>
                    <td><?php echo $cpf_usuario ?></td>
                    <td><?php echo $telefone_usuario ?></td>
                    <td><?php echo $email_usuario ?></td>
                    <td><?php echo $rua_usuario ?></td>
                    <td><?php echo $numero_usuario ?></td>
                    <td><?php echo $cidade_usuario ?></td>
                    <td><?php echo $bairro_usuario ?></td>
                    <td><?php echo $complemento_usuario ?></td>
                    <td><?php echo $nasc_usuario ?></td>
                    <td>
                        <b>
                            <font color ="<?php echo $cor_status ?>">
                                <?php echo $nome_status ?>
                            </font>
                        </b>
                    </td>
                </tr>
                <?php
            }
            */
        ?>
    </tbody>

</table>

<script src="js/consultas/CXTRCAD001CON/CXTRCAD001ACOES.js?time=<?php echo time(); ?>"></script>
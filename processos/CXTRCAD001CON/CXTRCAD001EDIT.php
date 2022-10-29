<?php
    //busca do user por id clicado, insersão dos dados do user no

date_default_timezone_set('America/Sao_Paulo');
session_start();
//inclusao da conexao
include('../../Connections/connpdo.php');
//inclusao da classe
include('../../classes/ClassUsuarios.php');
//recebimento do id do usuario via post
$id_usuario = $_POST['id_usuario'];

$busca = Usuarios::edit($conn, $id_usuario);

 //busca dos dados do usuario pelo id no banco de dados
 /*
$busca = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = $id_usuario");
//tenta executar a busca
try {
    $busca->execute();
} catch (PDOException $e) {
    $e->getMessage();
}
//salva os dados da busca no array associativo row
$row = $busca->fetch(PDO::FETCH_ASSOC);

    $nome_usuario = $row['nome_usuario'];
    $perfil_usuario = $row['perfil_usuario'];
    $email_usuario = $row['email_usuario'];
    $telefone_usuario = $row['telefone_usuario'];
    $rua_usuario = $row['rua_usuario'];
    $numero_usuario = $row['numero_usuario'];
    $bairro_usuario = $row['bairro_usuario'];
    $complemento_usuario = $row['complemento_usuario'];
    $cidade_usuario = $row['cidade_usuario'];
    $estado_usuario = $row['estado_usuario'];
    $nasc_usuarioUs = $row['nasc_usuario'];
    $nasc_usuarioBr = date("d/m/Y", strtotime($nasc_usuarioUs));
    $cpf_usuario = $row['cpf_usuario'];
*/
?>


<form class="needs-validation offset-md-12 col-md-12 " name="formulario" id="formulario" method="POST" novalidate>
    <input type="hidden" name="id_editar" id="id_editar" value="<?php echo $id_usuario; ?>" />
    <br>
    <div class="form-row">
        <div class="col-md-4">
            <label class="label_titulos">Nome</label>
            <input autocomplete="off" type="text" name="nome" id="nome" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['nome_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha o Nome!
            </div>
        </div>
        <div class="col-md-4">
            <label class="label_titulos">Email</label>
            <input maxlength="50" autocomplete="off" type="text" name="email" id="email" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['email_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha o Email!
            </div>
        </div>
        <div class="col-md-2">
            <label class="label_titulos">Perfil</label>
            <select class="form-control obrigatorios" name="perfil" id="perfil">
                <?php
                    $busca_perfis = $conn->prepare("SELECT * FROM perfis WHERE status_perfil = 1");
                    try {
                        $busca_perfis->execute();
                    } catch (PDOException $e) {
                        $e->getMessage();
                    }

                    while($row_perfil = $busca_perfis->fetch(PDO::FETCH_ASSOC)) {

                        $id_perfil = $row_perfil['id_perfil'];
                        $nome_perfil = $row_perfil['nome_perfil'];

                        if($id_perfil == $perfil_usuario) {
                            $selected_perfil = "selected";
                        } else {
                            $selected_perfil = "";
                        }

                        ?>
                            <option <?php echo $selected_perfil; ?> value="<?php echo $id_perfil; ?>"><?php echo $nome_perfil;?></option>
                        <?php
                    }
                ?>
            </select>
            <div class="invalid-feedback">
                Preencha o Perfil!
            </div>
        </div>
        <div class="col-md-2">
            <label class="label_titulos">Nascimento</label>
            <input maxlength="50" autocomplete="off" type="text" name="nascimento" id="nascimento" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['nasc_usuarioBr']; ?>" required />
            <div class="invalid-feedback">
                Preencha o Email!
            </div>
        </div>
        <div class="col-md-6">
            <label class="label_titulos">Rua</label>
            <input maxlength="50" autocomplete="off" type="text" name="rua" id="rua" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['rua_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha a Rua!
            </div>
        </div>
        <div class="col-md-2">
            <label class="label_titulos">Numero</label>
            <input maxlength="50" autocomplete="off" type="text" name="numero" id="numero" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['numero_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha a Rua!
            </div>
        </div>
        <div class="col-md-2">
            <label class="label_titulos">Bairro</label>
            <input maxlength="50" autocomplete="off" type="text" name="bairro" id="bairro" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['bairro_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha a Rua!
            </div>
        </div>
        <div class="col-md-2">
            <label class="label_titulos">Complemento</label>
            <input maxlength="50" autocomplete="off" type="text" name="complemento" id="complemento" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['complemento_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha a Rua!
            </div>
        </div>
        <div class="col-md-3">
            <label class="label_titulos">Telefone</label>
            <input maxlength="50" autocomplete="off" type="text" name="telefone" id="telefone" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['telefone_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha o Email!
            </div>
        </div>
        <div class="col-md-3">
            <label class="label_titulos">CPF</label>
            <input maxlength="50" oninput="mascara(this)" autocomplete="off" type="text" name="cpf" id="cpf" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['cpf_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha o Email!
            </div>
        </div>
        <div class="col-md-3">
            <label class="label_titulos">Cidade</label>
            <input maxlength="50" autocomplete="off" type="text" name="cidade" id="cidade" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['cidade_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha o Email!
            </div>
        </div>
        <div class="col-md-3">
            <label class="label_titulos">Estado</label>
            <input maxlength="50" autocomplete="off" type="text" name="estado" id="estado" style="height: 34px;" class="form-control obrigatorios" value="<?php echo $busca[0]['estado_usuario']; ?>" required />
            <div class="invalid-feedback">
                Preencha o Estado!
            </div>
        </div>
    </div>
    <br>
</form>
<script src="js/consultas/CXTRCAD001CON/CXTRCAD001EDITAR.js"></script>

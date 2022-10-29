<?php

  require_once("../Connections/connpdo.php");
  include('../classes/ClassAwsEditObject.php');

  date_default_timezone_set('America/Sao_Paulo');
  session_start();

  $acao = $_POST['acao'];
  $delimitador_pastas = '../';
  $pasta = "fotos_usuarios";
  
  if($acao == 'buscar') {

    $source = $_POST['source'];

  ?>
    <div class="form-row">
              <div class="col-md-6 offset-md-3" id="div_imagem_usuario">
                  <img id="imagem_usuario" style="width: 160px; height: 160px" src="<?php echo $source; ?>">
              </div>
          </div>
          <br>
          <br>
          <form name="form_foto" id="form_foto" enctype="multipart/form-data" method="POST">
              <div class="form_row">
                  <div class="col-md-12">
                      <label for="">Nova Foto</label>
                      <input onchange="substituirImagem(this)" type="file" name="nova_foto" id="nova_foto" class="form-control">
                  </div>
              </div>
          </form>
    </div>
  <?php

  } else if ($acao == 'editar') {

    $caminho_excluir = $_POST['caminho_excluir']; //caminho da imagem a ser excluida
    $objeto = $_FILES['nova_foto']['tmp_name'];
    $path = $_FILES['nova_foto']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $base = pathinfo($path, PATHINFO_FILENAME);
    $nome_objeto = $base.'_'.date("Y-m-d_H_i_s.").$ext;
  
    $retorno = AwsEditObject::editar($conn, $pasta, $objeto, $nome_objeto, $delimitador_pastas, $caminho_excluir);

    echo $retorno;
  }

?>

  


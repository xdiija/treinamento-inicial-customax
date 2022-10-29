<?php

  require_once("../Connections/connpdo.php");
  include('../classes/ClassAwsPutObject.php');

  date_default_timezone_set('America/Sao_Paulo');
  session_start();

  $user = $_SESSION['id_usuario'];
  $pasta = "fotos_usuarios";
  $objeto = $_FILES['file']['tmp_name'];
  $path = $_FILES['file']['name'];
  $ext = pathinfo($path, PATHINFO_EXTENSION);
  $base = pathinfo($path, PATHINFO_FILENAME);
  $nome_objeto = $base.'_'.date("Y-m-d_H_i_s.").$ext;
  $delimitador_pastas = '../';


  $retornoEnvio = AwsPutObject::enviar($conn, $pasta, $objeto, $nome_objeto, $delimitador_pastas);
  $retornoSave = AwsPutObject::salvarBd($conn, $pasta, $nome_objeto);
  
  echo $retornoSave;
  
?>
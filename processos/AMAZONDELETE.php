<?php

  require_once("../Connections/connpdo.php");
  include('../classes/ClassAwsDeleteObject.php');

  date_default_timezone_set('America/Sao_Paulo');
  session_start();

  $user = $_SESSION['id_usuario'];
  $caminho = $_POST['caminho'];
  $delimitador_pastas = '../';


  $retornoEnvio = AwsDeleteObject::deletar($conn, $caminho, $delimitador_pastas);

  
  echo $retornoEnvio;
  
?>
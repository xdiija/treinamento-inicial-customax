<?php

  require_once("../Connections/connpdo.php");
  include('../classes/ClassAwsLoadObject.php');

  date_default_timezone_set('America/Sao_Paulo');
  session_start();

  $user = $_SESSION['id_usuario'];
  $pasta = "fotos_usuarios";
  $delimitador_pastas = '../';


  $retornoEnvio = AwsLoadObject::carregar($conn, $delimitador_pastas);
  
  echo $retornoEnvio;
  
?>
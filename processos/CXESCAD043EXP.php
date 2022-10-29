<?php  
    require_once("../Connections/connpdo.php");
    session_start();
    $user = $_SESSION['id_usuario'];

 if(isset($_POST["export"]))  
 {  
    //$connect = mysqli_connect("localhost", "root", "", "testing");  
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=data.csv');  
    $output = fopen("php://output", "w");  

    fputcsv($output, array('ID', 'Tipo', 'Finame', 'Potência Modulo', 'Qtd Min Módulos', 'Qtd Max Módulos', 'Range Módulos', 'Cod Inversor 1', 'Cod Inversor 2', 'Cod Inversor 3', 'Qtd Inversor 1', 'Qtd Inversor 2', 'Qtd Inversor 3', 'Potência Inversor', 'Potência Trafo', 'Valor Comercial', 'Corrente 1', 'Corrente 2', 'Monitoramento', 'DPS CA', 'Disjuntor', 'Status'));

    $result = $conn->prepare("
        SELECT * FROM kits_sistema ORDER BY id_kit desc
    ");
    try {
        $result->execute();
    } catch (PDOException $e) {
        $e->getMessage();
    }
      while($row = $result->fetch(PDO::FETCH_ASSOC))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  
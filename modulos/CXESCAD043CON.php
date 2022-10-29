<?php
date_default_timezone_set('America/Sao_Paulo');

$user = $_SESSION['id_usuario'];
$perfil = $_SESSION['perfil_usuario'];

include('./Connections/connpdo.php');

$data_atual = date("d/m/Y");

$result = $conn->prepare("
    SELECT * FROM kits_sistema ORDER BY id_kit desc
");
try {
    $result->execute();
} catch (PDOException $e) {
    $e->getMessage();
}

?>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_SESSION['nome_sistema']; ?> | Consulta</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <link href="./css/checkbox.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@4.0.5/bootstrap-4/bootstrap-4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
   <script src="js/validarform.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>

</head>

<body>
<br /><br />  
           <div class="container" style="width:900px;">  
                <h2 align="center">Exportar dados em CSV</h2>  
                <h3 align="center">Kits</h3>                 
                <br />  
                <form method="post" action="processos/CXESCAD043EXP.php" align="center">  
                     <input type="submit" name="export" value="Exportar CSV" class="btn btn-success" />  
                </form>  
                <br />  
                <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">ID</th>  
                               <th width="5%">Tipo</th>  
                               <th width="5%">Finame</th>  
                               <th width="5%">Potência Modulo</th>  
                               <th width="5%">Qtd Min Módulos</th>
                               <th width="5%">Qtd Max Módulos</th>
                               <th width="5%">Range Módulos</th>
                               <th width="5%">Cod Inversor 1</th>
                               <th width="5%">Cod Inversor 2</th>
                               <th width="5%">Cod Inversor 3</th>
                               <th width="5%">Qtd Inversor 1</th>
                               <th width="5%">Qtd Inversor 2</th>
                               <th width="5%">Qtd Inversor 3</th>
                               <th width="5%">Potência Inversor</th>
                               <th width="5%">Potência Trafo</th>
                               <th width="5%">Valor Comercial</th>
                               <th width="5%">Corrente 1</th>
                               <th width="5%">Corrente 2</th>
                               <th width="5%">Monitoramento</th>
                               <th width="5%">DPS CA</th>
                               <th width="5%">Disjuntor</th>
                               <th width="5%">Status</th>
                          </tr>  
                     <?php  

                     while($row = $result->fetch(PDO::FETCH_ASSOC)) { 
                     ?>  
                          <tr>  
                               <td><?php echo $row["id_kit"]; ?></td>  
                               <td><?php echo $row["tipo_kit"]; ?></td>  
                               <td><?php echo $row["finame_kit"]; ?></td>  
                               <td><?php echo $row["potencia_modulo_kit"]; ?></td>  
                               <td><?php echo $row["qtd_min_modulos_kit"]; ?></td>  
                               <td><?php echo $row["qtd_max_modulos_kit"]; ?></td>
                               <td><?php echo $row["range_modulos_kit"]; ?></td>  
                               <td><?php echo $row["cod_inversor1_kit"]; ?></td>  
                               <td><?php echo $row["cod_inversor2_kit"]; ?></td>  
                               <td><?php echo $row["cod_inversor3_kit"]; ?></td>  
                               <td><?php echo $row["qtd_inversor1_kit"]; ?></td>  
                               <td><?php echo $row["qtd_inversor2_kit"]; ?></td>
                               <td><?php echo $row["qtd_inversor3_kit"]; ?></td>  
                               <td><?php echo $row["potencia_inversor_kit"]; ?></td>  
                               <td><?php echo $row["potencia_trafo_kit"]; ?></td>  
                               <td><?php echo $row["valor_comercial_kit"]; ?></td>  
                               <td><?php echo $row["corrente_inversores1_kit"]; ?></td>  
                               <td><?php echo $row["corrente_inversores2_kit"]; ?></td>  
                               <td><?php echo $row["monitoramento_kit"]; ?></td>  
                               <td><?php echo $row["dps_ca_kit"]; ?></td>  
                               <td><?php echo $row["disjuntor_comercial_kit"]; ?></td>  
                               <td><?php echo $row["status_kit"]; ?></td>  
                          </tr>  
                     <?php       
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>
    <script src="js/consultas/CXTRCAD001CON/CXTRCAD001FILTRO.js?time=<?php echo time(); ?>"></script>
</body>
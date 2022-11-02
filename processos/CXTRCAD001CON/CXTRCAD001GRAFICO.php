<?php

include('../../Connections/connpdo.php');

$busca = $conn->prepare("
    SELECT * FROM usuarios
");

try {
    $busca->execute();
} catch (PDOException $e) {
    $e->getMessage();
}

$rowcount = $busca->rowCount();

if ($rowcount != 0) {

	$final_array = array ();

    while($row = $busca->fetch(PDO::FETCH_ASSOC)) {
        $arr = array (
           'nome_usuario' => $row['nome_usuario'],
           'numero_usuario' => $row['numero_usuario'],
           'foto_usuario' => array( 'src' => $row['foto_usuario'])
        );
        $final_array [] = $arr;
    }

    $data = array(
        'status' => true,
        'msg' => 'successfully',
        'rowcount' => $rowcount,
        'data' => $final_array
    );
    
} else {

    $data = array(
        'status' => false,
        'msg' => "Record(s) not found."				
    );
    
}

echo json_encode( $data );

?>
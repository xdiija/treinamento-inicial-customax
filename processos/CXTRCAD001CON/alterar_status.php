<?php
    include('../../Connections/connpdo.php');
    include('../../classes/ClassUsuarios.php');

    $id_usuario = $_POST['id_usuario'];

    Usuarios::status($conn, $id_usuario);

    /*
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
    */
?>


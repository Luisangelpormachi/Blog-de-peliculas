<?php

require_once '../includes/connection.php';


if(isset($_SESSION['usuario']) && isset($_GET['id'])){

    $entrada_id = $_GET['id'];
    $id_usuario = $_SESSION['usuario']['id'];

    //para hacer la verificacion si es el usuario de la entrada
    $sql_old = "SELECT * FROM entradas WHERE usuario_id = $id_usuario AND id = $entrada_id";
    $ejecutar_old = mysqli_query($connection, $sql_old);

    $var = mysqli_num_rows($ejecutar_old);
    

    $sql = "DELETE FROM entradas WHERE usuario_id = $id_usuario AND id = $entrada_id";
    $ejecutar = mysqli_query($connection, $sql);
    

    if($ejecutar && $var >= 1){ 
        $_SESSION['message'] = "Eliminado correctamente";
    }else{
        $_SESSION['message'] = "Error al eliminar";
    }

}
header('location: ../index.php');

?>
<?php

if(isset($_POST)){
    
    require_once 'includes/connection.php';

    $titulo = isset($_POST["titulo"]) ? mysqli_real_escape_string($connection, $_POST["titulo"]) : false;
    $descripcion = isset($_POST["titulo"]) ? mysqli_real_escape_string($connection, $_POST["descripcion"]) : false;
    $categoria  = $_POST["categoria"];
    $usuario = $_SESSION["usuario"]["id"];

    //validar
    $errores = array();
    $campos = array();

    if(empty($titulo)){
        $errores['titulo'] = "insertar titulo";
    }else{
        $campos['titulo'] = $titulo;
    }

    if(empty($descripcion)){
        $errores['descripcion'] = "insertar descripcion";
    }else{
        $campos['descripcion'] = $descripcion;
    }

    if(empty($categoria) && !is_numeric($categoria)){
        $errores['categoria'] = "seleccionar categoria";
    }

    //insertar datos
    if(count($errores) == 0){

        $sql = "INSERT INTO entradas VALUES(NULL, $usuario, '$categoria', '$titulo', '$descripcion', CURDATE());";
        $ejecutar = mysqli_query($connection, $sql);
        
        

    }else{
        $_SESSION['campos_entradas'] = $campos;
        $_SESSION['errores_entradas'] = $errores;
        header("Location: crear-entradas.php");
        die();
    }

}


header('location: index.php');


?>
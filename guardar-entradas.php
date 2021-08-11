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

        if(isset($_GET['editar'])){

            $id_entrada = $_GET['editar'];
            $id_usuario = $_SESSION['usuario']['id'];

            $sql = "UPDATE  entradas SET titulo = '$titulo', descripcion = '$descripcion',  categoria_id = $categoria WHERE id = $id_entrada  AND usuario_id = $id_usuario";
            $ejecutar = mysqli_query($connection, $sql);

            $_SESSION['message'] = "Actualizado correctamente";
            header("Location: editar-entradas.php?id=".$_GET['editar']);

        }else{
            $sql = "INSERT INTO entradas VALUES(NULL, $usuario, '$categoria', '$titulo', '$descripcion', CURDATE());";
            $ejecutar = mysqli_query($connection, $sql);

            $_SESSION['message'] = "Agregado correctamente";
            header('location: index.php');
        }
    
        

    }else{
        $_SESSION['campos_entradas'] = $campos;
        $_SESSION['errores_entradas'] = $errores;

        if(isset($_GET['editar'])){
            header("Location: editar-entradas.php?id=".$_GET['editar']);
        }else{
            header("Location: crear-entradas.php");
        }
        
    }

}





?>
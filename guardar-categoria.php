<?Php

require_once 'includes/connection.php';


if(isset($_POST)){

    //recogienndo los valores del formulario de registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($connection, $_POST['nombre']) : false;

    //validar los campos de registros

    $errores = array();

    //validar nombres
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
       $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    //comprobar si existe errores
    if(count($errores) == 0){
        
        //insertar usuario a la base de datos
        $sql = "INSERT INTO categoria VALUES(NULL, '$nombre')";
        $ejecutar = mysqli_query($connection, $sql);


        if($ejecutar){
            $_SESSION['completado'] = "Registrado correctamente";
        }else{
            $_SESSION['errores']['general'] = "Fallo al registrar !!";
        }

        header('location: crear-categoria.php');

    }else{
    
    $_SESSION['errores'] = $errores;
    header('location: crear-categoria.php');

    }


}




?>
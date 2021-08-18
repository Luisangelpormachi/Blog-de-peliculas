<?php


if(isset($_POST['submit'])){

    //incluir connexion
    require_once '../includes/connection.php';

    
    //recogienndo los valores del formulario de registro

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($connection, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($connection, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($connection, $_POST['email']) : false;
    $usuario = $_SESSION['usuario'];

    //validar los campos de registros

    $errores = array();

    //validar nombres
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/',$nombre)){
       $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    //validar apellidos
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match('/[0-9]/',$apellidos)){
        $apellidos_validado = true;
    }else{
        $apellidos_validado = false;
        $errores['apellidos'] = 'Los apellidos no son validos';
    }

    //validar email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else{
        $email_validado = false;
        $errores['email'] = 'El email no es valido';
    }

    

    
    
    $guardar_usuario = false;

    if(count($errores) == 0){
        $guardar_usuario = true;

        //comprobar si el email ya existe

        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $ejecutar = mysqli_query($connection, $sql);

        $resultado = mysqli_fetch_assoc($ejecutar);

        if($resultado['id'] == $usuario['id'] || empty($resultado)){

            //insertar usuario a la base de datos
            $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos',  email = '$email' WHERE id =".$usuario['id'];
            $ejecutar = mysqli_query($connection, $sql);

            if($ejecutar){
            
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                
                $_SESSION['completado'] = "Registrado correctamente";

            }else{
                $_SESSION['errores']['general'] = "Fallo al registrar!!";
            }

        }else{
            
            $_SESSION['errores']['general'] = "Email registrado!!";
        }

        

    }else{
    
    $_SESSION['errores'] = $errores;

    }  
}

header('location: ../mis-datos.php');


?>
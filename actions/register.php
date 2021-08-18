<?php


if(isset($_POST['submit'])){

    //incluir connexion
    require_once '../includes/connection.php';

    //iniciar session el
    if(!isset($_SESSION)){
        session_start();
    }

    //recogienndo los valores del formulario de registro

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($connection, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($connection, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($connection, $_POST['email']) : false;
    $contraseña = isset($_POST['password']) ? mysqli_real_escape_string($connection, $_POST['password']) : false;
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : false;

    //validar los campos de registros

    $errores = array();
    $campos = array();

    //validar nombres
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/',$nombre)){
       $nombre_validado = true;
       $campos['nombre'] = $nombre;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    //validar apellidos
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match('/[0-9]/',$apellidos)){
        $apellidos_validado = true;
        $campos['apellidos'] = $apellidos;
    }else{
        $apellidos_validado = false;
        $errores['apellidos'] = 'Los apellidos no son validos';
    }

    //validar email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
        $campos['email'] = $email;
    }else{
        $email_validado = false;
        $errores['email'] = 'El email no es valido';
    }

    //validar contraseña
    if(!empty($contraseña)){
        $password_validado = true;
        $campos['password'] = $contraseña;
    }else{
        $errores['password'] = 'La contraseña esta vacia';
    }

    //validar contraseña confirm
    if(!empty($password_confirm) && ($password_confirm == $contraseña)){
        $password_validado = true;
        $campos['password_confirm'] = $contraseña;
    }else{
        $errores['password_confirm'] = 'La contraseña tiene que coincidir';
    }

    //verficar email existentes
    $sql = "SELECT email FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($connection, $sql);
    $total = mysqli_fetch_assoc($resultado);
    
    if(count($total) != 0){
        $errores['email_found'] = 'email ya existe !!';
    }
    
    $guardar_usuario = false;

    if(count($errores) == 0){
        $guardar_usuario = true;

        //cifrar la contraseña
        $password_segura = password_hash($contraseña, PASSWORD_BCRYPT, ['cost'=>4]);

        //insertar usuario a la base de datos
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $ejecutar = mysqli_query($connection, $sql);

        if($ejecutar){
            $_SESSION['completado'] = "Registrado correctamente";
        }else{
            $_SESSION['errores']['general'] = "Fallo al registrar !!";
        }

    }else{
    
    $_SESSION['campos_register'] = $campos;
    $_SESSION['errores'] = $errores;

    }

    // header('location: index.php');
    header('Location: ../index.php#login'); 

}

?>
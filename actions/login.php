<?php
    //importar la conexion que tambien ya contiene el session start
    require_once '../includes/connection.php';

    //comprobamos si existe datos en POST 
    if(isset($_POST)){

        $email = $_POST['email'];
        $password = $_POST['password'];


        //comprobar si existe el email en la base de dartos
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $ejecutar = mysqli_query($connection, $sql);

        if($ejecutar && mysqli_num_rows($ejecutar) == 1){
            $usuario = mysqli_fetch_assoc($ejecutar);

            //comprobar s coincide la contraseña
            $verify = password_verify($password, $usuario['password']);

            if($verify){
                //utilizar una sesion para guardar los datos del usuario logueado
                $_SESSION['usuario'] = $usuario;
                
                if(isset($_SESSION['error_login'])){
                    $_SESSION['error_login'] = null;
                }
            
            }else{
                //mensaje de error
                $_SESSION['campos_login']['email'] = $email;
                $_SESSION['error_login'] = 'password incorrecto!!';
            }


        }else{
            //mensaje de error
            $_SESSION['campos_login']['email'] = $email;
            $_SESSION['error_login'] = 'email no registrado!!';
        }

        
    }

    //redirigir al index
    
    // header('location: index.php');
    header('Location:' . getenv('HTTP_REFERER')); 




?>
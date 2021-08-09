<?php

    function mostrarError($session, $campo){
        $alert = '';
        if(isset($session[$campo]) && !empty($campo)){
            $alert = "<div class='alert alert-danger'>".$session[$campo]."</div>";
        }

        return $alert;
    }
    function mostrarCampo($session, $campo){
        $dato = '';
        if(isset($session[$campo]) && !empty($campo)){
        $dato = "$session[$campo]";
        }
        return $dato;
    }
    
    function borrarAlerts(){

        $borrado = false;

        if(isset($_SESSION['errores']))
        {
            $_SESSION['errores'] = null;
            $borrado = true;
        }

        if(isset($_SESSION['campos_register']))
        {
            $_SESSION['campos_register'] = null;
            $borrado = true;
        }

        if(isset($_SESSION['completado']))
        {
            $_SESSION['completado'] = null;
            $borrado = true;
        }
        
        if(isset($_SESSION['errores']['general']))
        {
            $_SESSION['errores']['general'] = null;
            $borrado = true;
        }

        if(isset($_SESSION['error_login'])){
            $_SESSION['error_login'] = null;
            $borrado = true;
        }
        
        if(isset($_SESSION['errores_entradas'])){
            $_SESSION['errores_entradas'] = null;
            $borrado = true;
        }

        if(isset($_SESSION['campos_entradas'])){
            $_SESSION['campos_entradas'] = null;
            $borrado = true;
        }

        if(isset($_SESSION['campos_login'])){
            $_SESSION['campos_login'] = null;
            $borrado = true;
        }
        
        return $borrado;
    }
    
    function getCategorias($connetion){

        $sql = "SELECT * FROM categoria ORDER BY id ASC;";
        $ejecutar = mysqli_query($connetion, $sql);

        $resultado = array();
        if($ejecutar && mysqli_num_rows($ejecutar) >= 1){
            
            $resultado = $ejecutar;
        }

        return $resultado;
    }

    function getCategoria($connetion, $id){

        $sql = "SELECT * FROM categoria WHERE id = $id";
        $ejecutar = mysqli_query($connetion, $sql);

        $resultado = array();
        if($ejecutar && mysqli_num_rows($ejecutar) >= 1){          
            $resultado = mysqli_fetch_assoc($ejecutar);
        }

        return $resultado;
    }

    function getEntradas($connection, $limit = null, $categoria = null){

        $sql = "SELECT e.*, c.nombre AS categoria FROM entradas e ".
               "INNER JOIN categoria c ON e.categoria_id = c.id ";
               
        if(!empty($categoria)){
            $sql .= "WHERE e.categoria_id = $categoria ";
        }

        $sql .= "ORDER BY e.id DESC ";

        if($limit){
            $sql .= "LIMIT 4";
        }
        
        $ejecutar = mysqli_query($connection, $sql);

        $resultado = array();
        if($ejecutar && mysqli_num_rows($ejecutar) >= 1){
            $resultado = $ejecutar;
        }

        return $resultado;
    }

    function getEntrada($connection, $id){

        //consulta para los registros sin usuarios exitentes

        $sql_old = "SELECT e.*, c.nombre AS categoria FROM entradas e ".
        "INNER JOIN categoria c ON e.categoria_id = c.id ".
        "WHERE e.id = $id";
        
        $ejecutar_old = mysqli_query($connection, $sql_old);

        //consulta para los registros con usuarios existentes

        $sql = "SELECT e.*, c.nombre AS categoria, u.nombre AS 'nombre', u.apellidos AS 'apellidos' FROM entradas e ".
               "INNER JOIN categoria c ON e.categoria_id = c.id ".
               "INNER JOIN usuarios u ON e.usuario_id = u.id ".
               "WHERE e.id = $id";
          
        $ejecutar = mysqli_query($connection, $sql);
        

        $resultado_old = array();
        $resultado = array();
        if(($ejecutar && mysqli_num_rows($ejecutar) >= 1) || ($ejecutar_old && mysqli_num_rows($ejecutar_old) >= 1)){
            $resultado  = mysqli_fetch_assoc($ejecutar);
            $resultado_old = mysqli_fetch_assoc($ejecutar_old);
        }
        
        return array($resultado_old, $resultado);
    }

   


?>
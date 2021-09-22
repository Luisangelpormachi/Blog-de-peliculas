<?php require_once 'includes/connection.php';?>
<?php require_once 'includes/helpers.php'?>

<!DOCTYPE HTML>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Blog de peliculas</title>

        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="shortcut icon" href="assets/img/favicon.png">     
      
        <script defer src="https://kit.fontawesome.com/93ef79ad81.js" crossorigin="anonymous"></script>
        <script defer src="assets/js/main2.js" type="text/javascript"></script>
    </head>
    <body>

        <!-- CABECERA -->
        <header id="header">
            <!-- LOGO -->
            <div id="logo">
                <a href="index.php">
                    Blog de peliculas
                </a>
                <button class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </button>  
            </div>
            <!-- MENU -->
            <nav class="nav"> 
                
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <?php
                    $categorias = getCategorias($connection);
    
                    if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):
                    ?>
                        <li>
                            <a href="categoria.php?id=<?= $categoria['id'] ?>"><?=$categoria['nombre']?></a>
                        </li>
                    <?php 
                        endwhile;
                    endif;
                    ?>
                    <li>
                        <a href="nosotros.php">Sobre mi</a>
                    </li>
                    <li>
                        <a href="contacto.php">Contacto</a>
                    </li>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </header>

        <div id="buscador-responsive" class="block-aside">
        
                <h3>Buscar</h3>
                <form action="buscar.php" method="post">
                
                    <input type="text" name="texto">
                    <input  class="btn" type="submit" name="buscar" value="buscar">
                </form>
        </div>

        <div id="container">
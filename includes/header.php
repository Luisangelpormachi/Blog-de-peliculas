<?php require_once 'includes/connection.php';?>
<?php require_once 'includes/helpers.php'?>

<!DOCTYPE HTML>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Blog de videos</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    </head>
    <body>

        <!-- CABECERA -->
        <header id="header">
            <!-- LOGO -->
            <div id="logo">
                <a href="index.php">
                    Blog de peliculas
                </a>
            </div>
            <!-- MENU -->
            <nav id="nav">   
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
                        <a href="index.php">Sobre mi</a>
                    </li>
                    <li>
                        <a href="index.php">Contacto</a>
                    </li>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </header>
        <div id="container">
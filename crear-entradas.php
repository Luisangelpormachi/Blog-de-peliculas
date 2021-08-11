<?php require_once 'includes/header.php';?>

            <?php require_once 'includes/sidebar.php';?>

            <?php require_once 'redireccion.php';?>

            <!-- CONTENIDO PRINCIPAL -->
            <div id="main">
                <h1>Crear Entradas</h1>
                <p>Agrega nuevas Entradas al blog para que los usuarios puedan leer mas contenido</p>
                <br>
                <form action="guardar-entradas.php" method="POST">
                    <label for="titulo">Titulo de entrada</label>
                    <input type="text" name="titulo" value="<?= isset($_SESSION['campos_entradas']['titulo']) ? $_SESSION['campos_entradas']['titulo'] : '';?>">
                    <?= isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'titulo') : '';?>
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion"><?= isset($_SESSION['campos_entradas']['descripcion']) ? $_SESSION['campos_entradas']['descripcion'] : '';?></textarea>
                    <?= isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'descripcion') : '';?>
                    <label for="categoria">Categoria de entrada</label>
                    <select name="categoria" class="my">
                        <?php 
                        $categorias = getCategorias($connection);
                        
                        if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):
                        ?>
                        <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                        <?php
                        endwhile;
                        endif;
                        ?>
                    </select>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : '';?>
                    <input class="btn" type="submit" value="Agregar">    
                </form> 
                <?php borrarAlerts(); ?>     
            </div> <!-- FIN PRINCIPAL -->

        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>
<?php require_once 'includes/header.php';?>

            <?php require_once 'includes/sidebar.php';?>

            <?php require_once 'redireccion.php';?>

            <!-- CONTENIDO PRINCIPAL -->
            <div id="main">
                <h1>Crear categorias</h1>
                <p>Agrega nuevas categorias al blog para que los usuarios puedan agregar mas contenido</p>
                <br>
                <form action="guardar-categoria.php" method="POST">
                    <?php if(isset($_SESSION['completado'])): ?>
                       <div class="alert alert-success"><?= $_SESSION['completado'] ?></div>
                    <?php endif; ?>
                    <?= isset($_SESSION['errores']['general']) ? $_SESSION['errores']['general'] : '';?>
                    <label for="nombre">Nombre de categoria</label>
                    <input type="text" name="nombre">
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';?>
                    <input class="btn" type="submit" value="Agregar">    
                </form>
                <?php borrarAlerts(); ?>      
            </div> <!-- FIN PRINCIPAL -->

        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>
<?php require_once 'includes/header.php';?>

            <?php require_once 'includes/sidebar.php';?>

            <?php require_once 'redireccion.php';?>

            <!-- CONTENIDO PRINCIPAL -->
            <div id="main">
                <h1>Mis datos</h1>
            
                <?php if(isset($_SESSION['completado'])) :?>
                    <div class="alert alert-success"><?= $_SESSION['completado'] ?></div>

                <?php elseif(isset($_SESSION['errores']['general'])) :?>
                    <div class="alert alert-danger"><?= $_SESSION['errores']['general'] ?></div>

                <?php elseif(isset($_SESSION['errores']['email_found'])) :?>
                    <div class="alert alert-danger"><?= $_SESSION['errores']['email_found'] ?></div>

                <?php endif; ?>

                <form action="actualizar-usuario.php" method="post">

                    <label for="nombre">Nombres</label>
                    <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>">
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';?>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos'] ?>">
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '';?>

                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?= $_SESSION['usuario']['email'] ?>">
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '';?>

                    <input type="submit" name="submit" value="Actualizar">
                </form>
                <?php borrarAlerts(); ?>
    
            </div> <!-- FIN PRINCIPAL -->

        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>
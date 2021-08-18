<?php require_once 'includes/header.php';?>

            <?php require_once 'includes/sidebar.php';?>

            <?php require_once 'actions/redireccion.php';?>

            <!-- CONTENIDO PRINCIPAL -->
            <div id="main">
                <h1>Mis datos</h1>
            
                <?php if(isset($_SESSION['completado'])) :?>
                    <div class="alert alert-success ocultar"><?= $_SESSION['completado'] ?></div>

                <?php elseif(isset($_SESSION['errores']['general'])) :?>
                    <div class="alert alert-danger ocultar"><?= $_SESSION['errores']['general'] ?></div>

                <?php elseif(isset($_SESSION['errores']['email_found'])) :?>
                    <div class="alert alert-danger ocultar"><?= $_SESSION['errores']['email_found'] ?></div>

                <?php endif; ?>

                <form action="actions/actualizar-usuario.php" method="post">

                    <label for="nombre">Nombres</label>
                    <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>">
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';?>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos'] ?>">
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '';?>

                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?= $_SESSION['usuario']['email'] ?>">
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '';?>

                    <input class="btn" type="submit" name="submit" value="Actualizar">
                </form>
                <?php borrarAlerts(); ?>
    
            </div> <!-- FIN PRINCIPAL -->

        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="assets/js/main.js" type="text/javascript"></script>
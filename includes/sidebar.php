

<!-- BARRA LATERAL -->
<aside id="sidebar">

    <div id="buscador-normal" class="block-aside">
        
        <h3>Buscar</h3>
        <form action="buscar.php" method="post">
           
            <input type="text" name="texto">
            <input  class="btn" type="submit" name="buscar" value="buscar">
        </form>
    </div>

    <?php if(isset($_SESSION['usuario'])):?>
        <div id="usuario-logueado" class="block-aside">    
            <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'] ?></h3>
            <a href="crear-entradas.php" class="btn btn-success">Crear entradas</a>
            <a href="crear-categoria.php" class="btn">Crear categoria</a>
            <a href="mis-datos.php" class="btn btn-warning">Mis datos</a>
            <a href="actions/close.php" class="btn btn-danger">Cerrar sesion</a>
        </div>
    <?php endif; ?>


    <?php if(!isset($_SESSION['usuario'])):?>

    <div id="login" class="block-aside">
    
        <h3>Identificate</h3>

        <?php if(isset( $_SESSION['error_login'])): ?>
            <div class="alert alert-danger ocultar">
                <?=  $_SESSION['error_login'] ?>
            </div>
        <?php endif; ?>

        <form action="actions/login.php" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?= isset($_SESSION['campos_login']['email']) ? $_SESSION['campos_login']['email'] : ''; ?>">

            <label for="password">Contraseña</label>
            <input type="password" name="password">

            <input  class="btn" type="submit" name="entrar" value="Entrar">
        </form>
    </div>
    <div id="register" class="block-aside">

        <?php if(isset($_SESSION['completado'])) :?>
            <div class="alert alert-success ocultar"><?= $_SESSION['completado'] ?></div>

        <?php elseif(isset($_SESSION['errores']['general'])) :?>
            <div class="alert alert-danger ocultar"><?= $_SESSION['errores']['general'] ?></div>

        <?php elseif(isset($_SESSION['errores']['email_found'])) :?>
            <div class="alert alert-danger ocultar"><?= $_SESSION['errores']['email_found'] ?></div>

        <?php endif; ?>
    
        <h3>Registrate</h3>
        <form action="actions/register.php" method="post">

            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" value="<?= isset($_SESSION['campos_register']['nombre']) ? mostrarCampo($_SESSION['campos_register'], 'nombre') : ''; ?>">
            <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';?>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?= isset($_SESSION['campos_register']['apellidos']) ? mostrarCampo($_SESSION['campos_register'], 'apellidos') : ''; ?>">
            <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '';?>

            <label for="email">Email</label>
            <input type="text" name="email" value="<?= isset($_SESSION['campos_register']['email']) ? mostrarCampo($_SESSION['campos_register'], 'email') : ''; ?>">
            <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '';?>

            <label for="password">Contraseña</label>
            <input type="password" name="password" value="<?= isset($_SESSION['campos_register']['password']) ? mostrarCampo($_SESSION['campos_register'], 'password') : ''; ?>">
            <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : '';?>

            <label for="password">Confirmar contraseña</label> </label>
            <input type="password" name="password_confirm" value="<?= isset($_SESSION['campos_register']['password_confirm']) ? mostrarCampo($_SESSION['campos_register'], 'password_confirm') : ''; ?>">
            <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password_confirm') : '';?>

            <input class="btn" type="submit" name="submit" value="Registrar">
        </form>
        <?php borrarAlerts(); ?>
    </div>

    <?php endif; ?>
</aside>
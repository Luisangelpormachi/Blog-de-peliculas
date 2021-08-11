<?php
require_once 'redireccion.php';
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

$entrada_actual = getEntrada($connection, $_GET['id']);

if(!isset($entrada_actual[0]['id'])){

    header('location: index.php');

}
elseif(($entrada_actual[0]['usuario_id']) != ($_SESSION['usuario']['id'])){

    header('location: index.php');
}

?>

<?php require_once 'includes/header.php';?>

            <?php require_once 'includes/sidebar.php';?>

             <!-- CONTENIDO PRINCIPAL -->
             <div id="main">
                <h1 class="mb">Editar Entrada</h1>
                
                <?php if(isset($_SESSION['message'])):?>
                    
                    <div class="alert alert-success ocultar"><?= $_SESSION['message'] ?></div>

                <?php endif; ?>

                <form action="guardar-entradas.php?editar=<?= $entrada_actual[0]['id']?> " method="POST">
                    <label for="titulo">Titulo de entrada</label>
                    <input type="text" name="titulo" value="<?= isset($_SESSION['campos_entradas']['titulo']) ? $_SESSION['campos_entradas']['titulo'] : $entrada_actual[0]['titulo'] ;?>">
                    <?= isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'titulo') : '';?>
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion"><?= isset($_SESSION['campos_entradas']['descripcion']) ? $_SESSION['campos_entradas']['descripcion'] : $entrada_actual[0]['descripcion'] ;?></textarea>
                    <?= isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'descripcion') : '';?>
                    <label for="categoria">Categoria de entrada</label>
                    <select name="categoria" class="my">
                        <?php 
                        $categorias = getCategorias($connection);
                        
                        if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):
                        ?>
                        <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $entrada_actual[0]['categoria_id'] ? "selected" : '') ?>><?= $categoria['nombre'] ?></option>
                        <?php
                        endwhile;
                        endif;
                        ?>
                    </select>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : '';?>
                    <input class="btn" type="submit" value="Actualizar">    
                </form> 
                <?php borrarAlerts(); ?>     
            </div> <!-- FIN PRINCIPAL -->

           

        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="assets/js/main.js" type="text/javascript"></script><?php borrarAlerts(); ?>


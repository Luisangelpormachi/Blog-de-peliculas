<?php

require_once 'includes/connection.php';
require_once 'includes/helpers.php';

$entrada_actual = getEntrada($connection, $_GET['id']);

if(!isset($entrada_actual[0]['id'])){
    header('location: index.php');
}
?>

<?php require_once 'includes/header.php';?>

            <?php require_once 'includes/sidebar.php';?>

            <!-- CONTENIDO PRINCIPAL -->
            <div id="main">

                <h1><?= $entrada_actual[0]['titulo'] ?></h1>

                <a href="categoria.php?id=<?= $entrada_actual[0]['categoria_id'] ?>">
                    <h2><?= $entrada_actual[0]['categoria'] ?></h2>
                </a>

                <span class="date-article"><?= $entrada_actual[0]['fecha'] ?> | <?= isset($entrada_actual[1]) ? $entrada_actual[1]['nombre'].' '.$entrada_actual[1]['apellidos'] : 'Sin autor'?></span>
                <p><?= $entrada_actual[0]['descripcion'] ?></p>

            </div> <!-- FIN PRINCIPAL -->

        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>


<?php

require_once 'includes/connection.php';
require_once 'includes/helpers.php';

$categoria_actual = getCategoria($connection, $_GET['id']);
if(!isset($categoria_actual['id'])){
    header('location: index.php');
}
?>

<?php require_once 'includes/header.php';?>

            <?php require_once 'includes/sidebar.php';?>

            <!-- CONTENIDO PRINCIPAL -->
            <div id="main">

                <h1 class="text-center my">Entradas de <?= $categoria_actual['nombre'] ?></h1>

                <?php 
                $entradas = getEntradas($connection, null, $_GET['id']);
                if(!empty($entradas)):
                    while($entrada = mysqli_fetch_assoc($entradas)):
                ?>


                <article class="entrada">
                    <a href="entrada.php?id=<?= $entrada['id'] ?>">
                        <h2><?= $entrada['titulo'] ?></h2>
                        <span class="date-article"><?= $entrada['categoria'].' | '.$entrada['fecha'] ?></span>
                        <p>
                        <?= substr($entrada['descripcion'], 0, 130).'...'?>
                        </p> 
                    </a>
                </article>

                <?php 
                    endwhile; 
                else:
                ?>

                <div class="alert alert-warning">No hay entradas en esta categoria</div>

                <?php
                endif;
                ?>


            </div> <!-- FIN PRINCIPAL -->

        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>


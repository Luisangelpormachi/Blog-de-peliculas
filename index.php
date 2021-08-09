<?php require_once 'includes/header.php';?>

            <?php require_once 'includes/sidebar.php';?>

            <!-- CONTENIDO PRINCIPAL -->
            <div id="main">
                <h1>Ultimas Entradas</h1>

                <?php 
                $entradas = getEntradas($connection, true);

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
                endif;
                ?>

                <div class="ver-todas">
                    <a href="entradas.php">Ver todas las entradas</a>
                </div>
            </div> <!-- FIN PRINCIPAL -->

        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>
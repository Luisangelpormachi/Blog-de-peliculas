<?php


    if(!isset($_POST['texto'])){
        header('Location: index.php');
    }

?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php';?>

<!-- CONTENIDO PRINCIPAL -->
<div id="main">
    <h1>Busqueda: <?= $_POST['texto'] ?></h1>
    
    <?php 
    $entradas = getEntradas($connection, null, null, $_POST['texto']);
    

    if(!empty($entradas)):
        while($entrada = mysqli_fetch_assoc($entradas)):

    ?>

    <article class="entrada mb">
        <a href="entrada.php?id=<?= $entrada['id'] ?>">
            <h2><?= $entrada['titulo'] ?></h2>
            <span class="date-article"><?= $entrada['categoria'].' | '.$entrada['fecha'] ?></span>
            <p>
            <?= $entrada['descripcion'] ?>
            </p> 
        </a>
    </article>
    
    <?php 
        endwhile;
    else:
    ?>
        <h3 class="mt">No hay registros</h3>
    <?php
    endif;
    ?> 
    

    <div class="ver-todas">
        <a class="btn" href="index.php">Ultimas entradas</a>
    </div>
</div> <!-- FIN PRINCIPAL -->

<?php require_once 'includes/footer.php'; ?>



</body>
</html>




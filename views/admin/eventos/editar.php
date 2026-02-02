<h2 class="dashboard__heading"><?= $titulo ?></h2>

<div class="dashboard__contenedor-boton">
  <a class="dashboard__boton" href="/admin/eventos">
    <i class="fa-solid fa-circle-arrow-left"></i>
    Volver
  </a>
</div>

<div class="dashboard__formulario">
  <?php require __DIR__.'/../../templates/alertas.php' ?> 

  <form method="post" class="formulario">
    <?php include __DIR__.'/formulario.php' ?>
  
    <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar Evento">
  </form>
</div>

<?php $script[] = '/build/js/pages/admin-eventos-crear.min.js'; ?>
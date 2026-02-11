<?php
include_once __DIR__ . '/conferencias.php';
?>

<section class="resumen">
  <div class="resumen__grid">
    <div class="resumen__bloque">
      <p class="resumen__texto resumen__texto--numero"><?= $ponentesTotal ?></p>
      <p class="resumen__texto">speakers</p>
    </div>
    <div class="resumen__bloque">
      <p class="resumen__texto resumen__texto--numero"><?= $conferenciasTotal ?></p>
      <p class="resumen__texto">Conferencias</p>
    </div>
    <div class="resumen__bloque">
      <p class="resumen__texto resumen__texto--numero"><?= $workshopsTotal ?></p>
      <p class="resumen__texto">Workshops</p>
    </div>
    <div class="resumen__bloque">
      <p class="resumen__texto resumen__texto--numero">500</p>
      <p class="resumen__texto">Asistentes</p>
    </div>
  </div>
</section>

<section class="speakers">
  <h2 class="speakers__heading">Speakers</h2>
  <p class="speakers__descripcion">Conoce a nuestros expertos de devwebcamp</p>

  <?php foreach ($ponentes as $ponente): ?>
    <div class="speaker">
      <picture>
        <source srcset="<?= $_ENV['HOST'] . "/img/speakers/" . $ponente->imagen . ".webp" ?>" type="image/webp">
        <source srcset="<?= $_ENV['HOST'] . "/img/speakers/" . $ponente->imagen . ".png" ?>" type="image/png">
        <img class="speaker__imagen" loading="lazy" width="200" height="300" src="<?= $_ENV['HOST'] . "/img/speakers/" . $ponente->imagen . ".png" ?>" alt="imagen ponente">
      </picture>

      <div class="speaker__informacion">
        <h4 class="speaker__nombre"><?= $ponente->nombre . ' ' . $ponente->apellido ?></h4>

        <p class="speaker__ubicacion"><?= $ponente->ciudad . ', ' . $ponente->pais ?></p>

        <nav class="speaker__sociales">
          <?php $redes = json_decode($ponente->redes) ?>
          <?php foreach ($redes as $red => $str): ?>
            <?php if (!empty($str)): ?>
              <a class="speaker__enlace" rel="noopener noreferrer" target="_blank" href="<?= $str ?>">
                <span class="speaker__ocultar"><?= strtoupper($red) ?></span>
              </a>
            <?php endif ?>
          <?php endforeach ?>
        </nav>

        <ul class="speaker__listado-skills">
          <?php
          $tags = explode(',', $ponente->tags);
          foreach ($tags as $tag): ?>
            <li class="speaker_skill"><?= $tag ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  <?php endforeach ?>
</section>
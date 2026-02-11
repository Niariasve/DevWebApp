<main class="agenda">
  <h2 class="agenda__heading"><?= $titulo ?></h2>
  <p class="agenda__descripcion">Talleres y conferencias dictados por expertos en desarrollo web</p>

  <div class="eventos">
    <h3 class="eventos__heading">
      &lt;Conferencias />
    </h3>
    <p class="eventos__fecha">Viernes 5 de Octubre</p>


    <div class="eventos__listado swiper">
      <div class="swiper-wrapper">
        <?php foreach ($eventos['conferencias_v'] as $evento): ?>
          <?php include __DIR__ . '/../templates/evento.php' ?> 
        <?php endforeach ?>
      </div>


      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

      <div class="swiper-pagination"></div>
    </div>


    <p class="eventos__fecha">Sabado 6 de Octubre</p>

    <div class="eventos__listado swiper">
      <div class="swiper-wrapper">
        <?php foreach ($eventos['conferencias_s'] as $evento): ?>
          <?php include __DIR__ . '/../templates/evento.php' ?> 
        <?php endforeach ?>
      </div>


      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

      <div class="swiper-pagination"></div>
    </div>
  </div>

  <div class="eventos eventos--workshops">
    <h3 class="eventos__heading">
      &lt;Workshops />
    </h3>
    <p class="eventos__fecha">Viernes 5 de Octubre</p>

    <div class="eventos__listado swiper">
      <div class="swiper-wrapper">
        <?php foreach ($eventos['workshops_v'] as $evento): ?>
          <?php include __DIR__ . '/../templates/evento.php' ?> 
        <?php endforeach ?>
      </div>


      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

      <div class="swiper-pagination"></div>
    </div>
  </div>

    <p class="eventos__fecha">Sabado 6 de Octubre</p>

    <div class="eventos__listado swiper">
      <div class="swiper-wrapper">
        <?php foreach ($eventos['workshops_s'] as $evento): ?>
          <?php include __DIR__ . '/../templates/evento.php' ?> 
        <?php endforeach ?>
      </div>


      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

      <div class="swiper-pagination"></div>
    </div>
  </div>
  </div>
</main>


<?php $script[] = vite_asset('src/js/pages/public-workshops.js') ?>
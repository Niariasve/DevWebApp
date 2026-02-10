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
          <div class="evento swiper-slide">
            <p class="evento__hora"><?= $evento->hora()->hora ?></p>

            <div class="evento__informacion">
              <div>
                <h4 class="evento__nombre"><?= $evento->nombre ?></h4>

                <p class="evento__introduccion"><?= $evento->descripcion ?></p>
              </div>

              <div class="evento__autor-info">
                <picture>
                  <source srcset="<?= $_ENV['HOST'] . "/img/speakers/" . $evento->ponente()->imagen . ".webp" ?>" type="image/webp">
                  <source srcset="<?= $_ENV['HOST'] . "/img/speakers/" . $evento->ponente()->imagen . ".png" ?>" type="image/png">
                  <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="<?= $_ENV['HOST'] . "/img/speakers/" . $evento->ponente()->imagen . ".png" ?>" alt="imagen ponente">
                </picture>

                <p class="evento__autor-nombre"><?= $evento->ponente()->nombre ?></p>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>

      <div class="swiper-pagination"></div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

    </div>


    <p class="eventos__fecha">Sabado 6 de Octubre</p>

    <div class="eventos__listado"></div>
  </div>

  <div class="eventos eventos--workshops">
    <h3 class="eventos__heading">
      &lt;Workshops />
    </h3>
    <p class="eventos__fecha">Viernes 5 de Octubre</p>

    <div class="eventos__listado"></div>

    <p class="eventos__fecha">Sabado 6 de Octubre</p>

    <div class="eventos__listado"></div>
  </div>
</main>


<?php $script[] = vite_asset('src/js/pages/public-workshops.js') ?>
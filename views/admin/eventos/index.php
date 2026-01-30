<h2 class="dashboard__heading"><?= $titulo ?></h2>

<div class="dashboard__contenedor-boton">
  <a class="dashboard__boton" href="/admin/eventos/crear">
    <i class="fa-solid fa-circle-plus"></i>
    Añadir Evento
  </a>
</div>

<div class="dashboard__contenedor">
  <?php if(!empty($eventos)): ?>
    <table class="table">
      <thead class="table__thead">
        <tr>
          <th scope="col" class="table__th">Evento</th>
          <th scope="col" class="table__th">Tipo</th>
          <th scope="col" class="table__th">Dia y Hora</th>
          <th scope="col" class="table__th">evento</th>
          <th scope="col" class="table__th"></th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach($eventos as $evento): ?>
          <tr class="table__tr">
            <td class="table__td">
              <?= $evento->nombre ?>
            </td>
            <td class="table__td">
              <?= $evento->categoria()->nombre ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="text-center">No hay eventos registrados.</p>
  <?php endif; ?>
</div>

<?= $paginacion ?>
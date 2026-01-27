<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información del Evento</legend>

  <div class="formulario__campo">
    <label for="nombre" class="formulario__label">Nombre Evento</label>
    <input
      type="text"
      class="formulario__input"
      id="nombre"
      name="nombre"
      placeholder="Nombre Evento"
      value="<?= $evento->nombre ?? '' ?>">
  </div>

  <div class="formulario__campo">
    <label for="descripcion" class="formulario__label">Descripción Evento</label>
    <textarea
      class="formulario__input"
      id="descripcion"
      name="descripcion"
      placeholder="Descripcion Evento"
      rows="8"><?= $evento->descripcion ?? '' ?></textarea>
  </div>

  <div class="formulario__campo">
    <label for="categoria" class="formulario__label">Tipo de Evento</label>
    <select name="categoria_id" id="categoria" class="formulario__select">
      <option value="" <?= is_null($evento->categoria_id) ? 'selected' : '' ?> disabled>Seleccione una categoria</option>
      <?php foreach($categorias as $categoria): ?>
        <option 
          value="<?= $categoria->id ?>" 
          <?= $evento->categoria_id == $categoria->id ? 'selected' : '' ?>>
          <?= $categoria->nombre ?>
        </option>
      <?php endforeach; ?> 
    </select>
  </div>

  <div class="formulario__campo">
    <label for="dia" class="formulario__label">Selecciona el Día</label>

    <div class="formulario__radio">
      <?php foreach($dias as $dia): ?>
        <div>
          <label for="<?= strtolower($dia->nombre) ?>"><?= $dia->nombre ?></label>
          <input 
            type="radio" 
            name="dia" 
            id="<?= strtolower($dia->nombre) ?>" 
            value="<?= $dia->id ?>">
        </div>
      <?php endforeach; ?>
    </div>

    <input type="hidden" name="dia_id" value="">
  </div>

  <div class="formulario__campo">
    <label for="" class="formulario__label">Seleccionar Hora</label>
    <ul id="horas" class="horas">
      <?php foreach($horas as $hora): ?>
        <li class="horas__hora horas__hora--deshabilitada" data-hora-id="<?= $hora->id ?>"><?= $hora->hora ?></li>
      <?php endforeach; ?>
    </ul>

    <input type="hidden" name="hora_id" value="">
  </div>

</fieldset>

<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información Extra</legend>

  <div class="formulario__campo">
    <label for="ponentes" class="formulario__label">Ponentes</label>
    <input 
      type="text"
      class="formulario__input"
      id="ponentes"
      placeholder="Buscar Ponente">
  </div>

  <div class="formulario__campo">
    <label for="disponibles" class="formulario__label">Lugares Disponibles</label>
    <input
      type="number"
      min="1"
      class="formulario__input"
      id="disponibles"
      name="disponibles"
      placeholder="Ej. 20"
      value="<?= $eventos->disponibles ?? '' ?>">
  </div>

</fieldset>
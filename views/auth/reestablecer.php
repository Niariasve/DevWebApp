<main class="auth">
  <h2 class="auth__heading"><?= $titulo ?></h2>
  <p class="auth__texto">Coloca tu nuevo password</p>

  <?php require __DIR__.'/../templates/alertas.php' ?> 

  <form method="post" class="formulario">

    <?php if($token_valido) { ?>
      <div class="formulario__campo">
        <label for="password" class="formulario__label">Password</label>
        <input
          type="password"
          class="formulario__input"
          placeholder="Tu Nuevo Password"
          id="password"
          name="password" />
      </div>
    <?php } ?>
    
    <input type="submit" class="formulario__submit" value="Guardar Password">
  </form>

  <div class="acciones">
    <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia sesión</a>
    <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Obtener una</a>
  </div>
</main>
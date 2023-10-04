<div class="contenedor olvide">
  <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

  <div class="contenedor-sm">
    <p class="descripcion-pagina">Recupera tu Acceso UpTask</p>

    <form action="/olvide" class="formulario" method="POST">
      <div class="campo">
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          placeholder="Tu Email"
          name="email"
        >
      </div>

      <input type="submit" class="boton" value="Enviar Instrucciones"/>
    </form>

    <div class="acciones">
      <a href="/">¿Ya Tienes una Cuenta? Inicia Sesión</a>
      <a href="/crear">¿Aún No Tienes una Cuenta? Crear Una</a>
    </div>
  </div> <!-- Contenedor-sm   -->
</div>


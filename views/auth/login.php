<div class="contenedor">
  <h1>UpTask</h1>
  <p class="tagline">Crea y Administra tus Proyectos</p>

  <div class="contenedor-sm">
    <p class="descripcion-pagina">Iniciar Sesión</p>

    <form action="/" class="formulario" method=""POST>
      <div class="campo">
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          placeholder="Tu Email"
          name="email"
        >
      </div>

      <div class="campo">
        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          placeholder="Tu Password"
          name="password"
        >
      </div>

      <input type="submit" class="boton" value="Iniciar Sesión">
    </form>

    <div class="acciones">
      <a href="/crear">¿Aún No Tienes una Cuenta? Obtener Una</a>
      <a href="/olvide">¿Olvidaste tu Password?</a>
    </div>
  </div> <!-- Contenedor-sm   -->
</div>


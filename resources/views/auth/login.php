<div class="contenedor login">
    <?php include_once __DIR__ .'/../partials/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

         <?php include_once __DIR__ .'/../partials/alertas.php'; ?>

        <form action="/login" method="post" class="formulario" novalidate>
            <div class="campo">
                <input
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email" />
            </div>
            <div class="campo">
                <input
                    type="password"
                    id="password"
                    placeholder="Tu Contraseña"
                    name="password" />
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>

        <div class="acciones">
            <a href="/crear">Crear una cuenta</a>
            <a href="/olvide">¿Olvidaste la contraseña?</a>
        </div>
    </div>
</div>
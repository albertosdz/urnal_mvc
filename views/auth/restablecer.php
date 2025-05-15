<div class="contenedor restablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Nueva Contraseña</p>

        <form action="/restablecer" method="post" class="formulario">

            <div class="campo">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    placeholder="Tu Contraseña"
                    name="password" />
            </div>

            <input type="submit" class="boton" value="Guardar Contraseña">
        </form>

        <div class="acciones">
            <a href="/crear">Crear una cuenta</a>
            <a href="/olvide">¿Olvidaste la contraseña?</a>
        </div>
    </div>
</div>
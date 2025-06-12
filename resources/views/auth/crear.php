<div class="contenedor crear">
    <?php include_once __DIR__ . '/../partials/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crear Cuenta</p>
        <?php include_once __DIR__ . '/../partials/alertas.php'; ?>

        <form action="/crear" method="post" class="formulario">
            <div class="campo">
                <input
                    type="text"
                    id="nombre"
                    placeholder="Tu Nombre"
                    name="nombre"
                    value="<?php echo $usuario->nombre; ?>" />

            </div>
            <div class="campo">
                <input
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email"
                    value="<?php echo $usuario->email; ?>" />
            </div>
            <div class="campo">
                <input
                    type="password"
                    id="password"
                    placeholder="Tu Contraseña"
                    name="password" />
            </div>

            <div class="campo">
                <input
                    type="password"
                    id="password2"
                    placeholder="Repite la Contraseña"
                    name="password2" />
            </div>

            <input type="submit" class="boton" value="Crear Cuenta">
        </form>

        <div class="acciones">
            <a href="/login">¿Ya tienes cuenta? Inicia Sesión</a>
            <a href="/olvide">¿Olvidaste la contraseña?</a>
        </div>
    </div>
</div>
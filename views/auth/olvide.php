<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recuperar contraseña de Urnal</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>


        <form action="/olvide" method="post" class="formulario">
            <div class="campo">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email" />
            </div>

            <input type="submit" class="boton" value="Enviar Correo">
        </form>

        <div class="acciones">
            <a href="/login">¿Ya tienes cuenta? Inicia Sesión</a>
            <a href="/crear">Crear una cuenta</a>
        </div>
    </div>
</div>
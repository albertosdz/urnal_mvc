<div class="contenedor login">
    <h1 class="logo">Urnal</h1>
    <p class="tagline">Crea Tareas, Administra Proyectos</p>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <form action="/login" method="post" class="formulario">
            <div class="campo">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email" />
            </div>
            <div class="campo">
                <label for="password">Contraseña</label>
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
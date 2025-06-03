<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

    <a href="/perfil" class="enlace" >Editar Perfil</a>


    <form class="formulario" method="post" action="/cambiar-contraseña">
        <div class="campo">
            <label for="contraseña_actual">Contraseña Actual</label>
            <input
                type="password"
                name="contraseña_actual"
                placeholder="Introduzca su Contraseña Actual" />
        </div>

        <div class="campo">
            <label for="contraseña_nueva">Nueva Contraseña</label>
            <input
                type="password"
                name="contraseña_nueva"
                placeholder="Actualiza tu contraseña" />
        </div>

        <input type="submit" value="Guardar Cambios">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<div class="menu-btn sidebar-btn" id="sidebar-btn">
    <img src="build/img/menu.svg" alt="arrow">
    <img src="build/img/cerrar.svg" alt="arrow">
</div>
<aside class="sidebar" id="sidebar">

    <div class="menu-btn" id="menu-btn">
        <img src="build/img/arrow.svg" alt="arrow">
    </div>

    <a href="/dashboard" class="brand">
        <img src="build/img/logo.png" alt="logo">
        <h2>rnal</h2>
    </a>

    <nav class="menu">
        <div class="menu-item menu-item-static">
            <a href="/dashboard" class="<?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?> menu-link">
                <img src="build/img/proyectos.svg" alt="proyectos">
                <p>Proyectos</p>
            </a>
        </div>

        <div class="menu-item menu-item-static">
            <a href="/crear-proyecto" class="<?php echo ($titulo === 'Crear Proyecto') ? 'activo' : ''; ?> menu-link">
                <img src="build/img/crear.svg" alt="crear">
                <p>Crear Proyecto</p>
            </a>
        </div>

        <div class="menu-item menu-item-static">
            <a href="/perfil" class="<?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?> menu-link">
                <img src="build/img/perfil.svg" alt="perfil">
                <p>Perfil</p>
            </a>
        </div>

        <div class="menu-item menu-item-static logout">
            <a href="/logout" class="menu-link" id="logout-btn">
                <img src="build/img/logout.svg" alt="perfil">
                <p>Cerrar Sesión</p>
            </a>
        </div>
    </nav>

</aside>
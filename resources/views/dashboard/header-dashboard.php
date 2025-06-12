<div class="dashboard">
    <?php include_once __DIR__ . '/../partials/sidebar.php'; ?>

    <div class="principal">
        <?php include_once __DIR__ . '/../partials/barra.php'; ?>

        <div class="contenido <?php echo ($titulo === 'Crear Proyecto' || $titulo === 'Perfil' || $titulo === 'Cambiar Contraseña') ? 'form-centrado' : ''; ?>">
            <h2 class="nombre-pagina "><?php echo $titulo; ?></h2>
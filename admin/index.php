<?php
session_start(); // Iniciar sesión para acceder a $_SESSION

require '../includes/funciones.php';
incluirTemplate('header');

$exito = $_SESSION['exito'] ?? '';
unset($_SESSION['exito']); // Se elimina la variable después de asignarla a $exito
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>

    <?php if (!empty($exito)): ?>
        <div class="alerta success">
            <?php echo $exito; ?>
        </div>
    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
</main>

<?php
incluirTemplate('footer');
?>

<?php
    // Conexion import
    require '../includes/config/database.php';
    $db = conectarDB();

    // Query para obtener todas las propiedades
    $query = "SELECT * FROM propiedades";

    // Ejecutar consulta
    $resultQuery = mysqli_query($db, $query);

    session_start(); // Iniciar sesión para acceder a $_SESSION

    require '../includes/funciones.php';
    incluirTemplate('header');

    // Recuperar mensaje de éxito
    $exito = $_SESSION['exito'] ?? '';
    unset($_SESSION['exito']); // Eliminar la variable después de asignarla a $exito
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>

    <!-- Mostrar mensaje de éxito -->
    <?php if (!empty($exito)): ?>
        <div class="alerta success">
            <?php echo htmlspecialchars($exito); ?>
        </div>
    <?php endif; ?>

    <!-- Enlace para agregar una nueva propiedad -->
    <a href="/bienesraices_inicio/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <!-- Tabla para mostrar las propiedades -->
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar resultados -->
            <?php while($propiedad = mysqli_fetch_assoc($resultQuery)): ?>

            <tr>
                <td> <?php echo (int)$propiedad['id']; ?></td>
                <td> <?php echo htmlspecialchars($propiedad['titulo']); ?> </td>
                <td>
                    <img src="/bienesraices_inicio/imagenes/<?php echo htmlspecialchars($propiedad['imagen']); ?>" class="image-table" alt="Imagen propiedad">
                </td>
                <td>$ <?php echo number_format((float)$propiedad['precio'], 2); ?></td>
                <td class="acciones">
                    <form method="POST" action="/bienesraices_inicio/admin/propiedades/borrar.php" onsubmit="return confirm('¿Deseas eliminar esta propiedad?');">
                        <input type="hidden" name="id" value="<?php echo (int)$propiedad['id']; ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>

                    <a href="/bienesraices_inicio/admin/propiedades/actualizar.php?id=<?php echo (int)$propiedad['id']; ?>" class="boton-verde-block">
                        Actualizar
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
    mysqli_close($db); // Cerrar la conexión
    incluirTemplate('footer');
?>

<!-- Script para manejar el Dark Mode -->
<script>
    const darkModeBtn = document.querySelector('.dark-mode-boton');
    const body = document.body;

    // Verifica si hay preferencia guardada en localStorage
    if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    // Cambiar entre modo claro y oscuro
    darkModeBtn.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        
        // Guardar la preferencia en localStorage
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', 'disabled');
        }
    });
</script>

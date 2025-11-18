<?php
session_start();

require '../../includes/config/database.php';
$db = conectarDB();

// Validar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$id = $_POST['id'] ?? null;

// Validar ID
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../index.php');
    exit;
}

// Obtener la imagen asociada a la propiedad
$query = "SELECT imagen FROM propiedades WHERE id = $id LIMIT 1";
$resultado = mysqli_query($db, $query);

if ($resultado && $resultado->num_rows > 0) {

    $propiedad = mysqli_fetch_assoc($resultado);
    $imagen = $propiedad['imagen'];

    // Ruta de la imagen
    $rutaImagen = "../../imagenes/$imagen";

    // Borrar propiedad de la BD
    $queryEliminar = "DELETE FROM propiedades WHERE id = $id";
    $resultadoEliminar = mysqli_query($db, $queryEliminar);

    if ($resultadoEliminar) {
        
        // Borrar imagen si existe
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }

        $_SESSION['exito'] = "Propiedad eliminada correctamente";
        header('Location: ../index.php');
        exit;

    } else {
        echo "<h3>Error al eliminar en la base de datos.</h3>";
        echo mysqli_error($db);
    }

} else {
    echo "<h3>No existe la propiedad seleccionada.</h3>";
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Eliminar Propiedad</h1>
    <p>Si ves este mensaje, algo salió mal. Usa el panel para volver.</p>

    <a href="../index.php" class="boton boton-verde">Volver al Panel</a>
</main>

<?php incluirTemplate('footer'); ?>

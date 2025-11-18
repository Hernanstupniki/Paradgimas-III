<?php
session_start();

require '../../includes/config/database.php';
$db = conectarDB();

// Validar ID por GET
$id = $_GET['id'] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../index.php');
    exit;
}

// Obtener la propiedad actual
$queryProp = "SELECT * FROM propiedades WHERE id = $id LIMIT 1";
$resProp = mysqli_query($db, $queryProp);
$propiedad = mysqli_fetch_assoc($resProp);

// Si no existe → vuelve al admin
if (!$propiedad) {
    header('Location: ../index.php');
    exit;
}

// Obtener vendedores
$queryVend = "SELECT * FROM vendedores";
$resVend = mysqli_query($db, $queryVend);

// Crear arreglo de errores
$errores = [];

// Variables para llenar el formulario
$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorID = $propiedad['vendedores_id'];
$imagenActual = $propiedad['imagen'];
$credo = $propiedad['credo'];

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorID = mysqli_real_escape_string($db, $_POST['vendedores_id']);

    $imagen = $_FILES['imagen'];

    // Validaciones
    if (!$titulo) $errores[] = "El título es obligatorio";
    if (!$precio) $errores[] = "El precio es obligatorio";
    if (strlen($descripcion) < 50) $errores[] = "La descripción debe tener al menos 50 caracteres";
    if (!$habitaciones) $errores[] = "Las habitaciones son obligatorias";
    if (!$wc) $errores[] = "Los baños son obligatorios";
    if (!$estacionamiento) $errores[] = "El estacionamiento es obligatorio";
    if (!$vendedorID) $errores[] = "Debes seleccionar un vendedor";

    // Si no hay errores
    if (empty($errores)) {

        // Carpeta de imágenes
        $carpetaImagenes = '../../imagenes/';

        // Manejo de imagen
        if ($imagen['name']) {

            // Validar extensión
            if ($imagen['type'] !== 'image/jpeg' && $imagen['type'] !== 'image/png') {
                $errores[] = 'Formato no válido (solo JPG o PNG)';
            }

            // Si es válida, borrar imagen anterior
            if (file_exists($carpetaImagenes . $imagenActual)) {
                unlink($carpetaImagenes . $imagenActual);
            }

            // Subir imagen nueva
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        } else {
            // Si NO sube nueva → conservar la actual
            $nombreImagen = $imagenActual;
        }

        // Actualizar en la BD
        $queryUpdate = "
            UPDATE propiedades SET
                titulo = '$titulo',
                precio = '$precio',
                imagen = '$nombreImagen',
                descripcion = '$descripcion',
                habitaciones = '$habitaciones',
                wc = '$wc',
                estacionamiento = '$estacionamiento',
                vendedores_id = '$vendedorID'
            WHERE id = $id
        ";

        $resultado = mysqli_query($db, $queryUpdate);

        if ($resultado) {
            $_SESSION['exito'] = "Propiedad actualizada correctamente";
            header('Location: ../index.php');
            exit;
        } else {
            echo "<pre>ERROR SQL: " . mysqli_error($db) . "</pre>";
        }
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>">

            <label>Imagen Actual:</label>
            <img src="/imagenes/<?php echo $imagenActual; ?>" class="imagen-small">

            <label for="imagen">Imagen Nueva:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Detalles de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id">
                <option value="">-- Seleccione --</option>
                <?php while($vendedor = mysqli_fetch_assoc($resVend)): ?>
                    <option 
                        value="<?php echo $vendedor['id']; ?>"
                        <?php echo $vendedorID == $vendedor['id'] ? 'selected' : ''; ?>>
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <div class="botones-crear">
            <a href="../index.php" class="boton boton-verde">Volver</a>
            <input type="submit" class="boton boton-verde" value="Actualizar Propiedad">
        </div>
    </form>

</main>

<?php incluirTemplate('footer'); ?>

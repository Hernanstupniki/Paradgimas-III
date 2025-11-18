<?php
session_start();

require '../../includes/config/database.php';
$db = conectarDB();

// Consultar vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Arreglo con mensajes de errores
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorID = '';
$credo = date('Y-m-d'); // TU COLUMNA SE LLAMA "credo"

// Ejecutar cuando el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitizar y asignar
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorID = mysqli_real_escape_string($db, $_POST['vendedores_id']);

    // Imagen
    $imagen = $_FILES['imagen'];

    // Validaciones
    if (!$titulo) $errores[] = "Debes añadir un título";
    if (!$precio) $errores[] = "El precio es obligatorio";
    if (strlen($descripcion) < 50) $errores[] = "La descripción debe tener mínimo 50 caracteres";
    if (!$habitaciones) $errores[] = "El número de habitaciones es obligatorio";
    if (!$wc) $errores[] = "El número de baños es obligatorio";
    if (!$estacionamiento) $errores[] = "El número de estacionamientos es obligatorio";
    if (!$vendedorID) $errores[] = "Debes seleccionar un vendedor";
    if (!$imagen['name'] || $imagen['error']) $errores[] = "La imagen es obligatoria";

    // Validación imagen
    if ($imagen['name']) {

        if (!($imagen['type'] === "image/jpeg" || $imagen['type'] === "image/png")) {
            $errores[] = "La imagen debe ser JPG o PNG";
        }

        $medida = 1000 * 1000; // 1MB
        if ($imagen['size'] > $medida) {
            $errores[] = "La imagen es demasiado pesada (máx 1MB)";
        }
    }

    // Si no hay errores → insertar
    if (empty($errores)) {

        // Carpeta de imágenes
        $carpetaImagenes = '../../imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Nombre único para imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Subir imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        // Query final CORRECTA
        $query = "
            INSERT INTO propiedades 
            (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, credo, vendedores_id) 
            VALUES 
            ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$credo', '$vendedorID')
        ";

        $resultadoInsert = mysqli_query($db, $query);

        if ($resultadoInsert) {
            $_SESSION['exito'] = "Se añadió una propiedad correctamente";
            header('Location: ../index.php');
            exit;
        } else {
            echo "<pre>Error SQL: " . mysqli_error($db) . "</pre>";
        }
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" min="1" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id">
                <option value="">-- Seleccione --</option>

                <?php while ($vendedor = mysqli_fetch_assoc($resultado)): ?>
                    <option 
                        value="<?php echo $vendedor['id']; ?>"
                        <?php echo ($vendedorID == $vendedor['id']) ? 'selected' : ''; ?>
                    >
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <div class="botones-crear">
            <a href="../index.php" class="boton boton-verde">Volver</a>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </div>

    </form>
</main>

<?php incluirTemplate('footer'); ?>

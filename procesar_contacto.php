<?php
    // Incluir la conexión a la base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Obtener los datos del formulario y escaparlos
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
        $mensaje = mysqli_real_escape_string($db, $_POST['mensaje']);
        $tipo_contacto = mysqli_real_escape_string($db, $_POST['contacto']);
        $presupuesto = mysqli_real_escape_string($db, $_POST['presupuesto']);
        $fecha_contacto = mysqli_real_escape_string($db, $_POST['fecha']);
        $hora_contacto = mysqli_real_escape_string($db, $_POST['hora']);

        // Insertar los datos en la base de datos
        $query = "INSERT INTO contacto (nombre, email, telefono, mensaje, tipo_contacto, presupuesto, fecha_contacto, hora_contacto)
                  VALUES ('$nombre', '$email', '$telefono', '$mensaje', '$tipo_contacto', '$presupuesto', '$fecha_contacto', '$hora_contacto')";

        if (mysqli_query($db, $query)) {
            // Redirigir a la página de éxito con un mensaje
            session_start();
            $_SESSION['exito'] = 'Mensaje enviado correctamente';
            header('Location: contacto.php');
        } else {
            // Mostrar error si la inserción falla
            echo "Error al enviar el mensaje: " . mysqli_error($db);
        }
    }

    // Cerrar la conexión
    mysqli_close($db);
?>

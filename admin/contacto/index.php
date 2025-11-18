<?php
require '../../includes/config/database.php';
$db = conectarDB();

// Consulta de mensajes de contacto
$query = "SELECT * FROM contacto ORDER BY id DESC";
$resultContactos = mysqli_query($db, $query);

require '../../includes/funciones.php';
incluirTemplate('header', false);
?>

<main class="contenedor seccion contacto-admin">
    <h1>Mensajes de Contacto</h1>

    <div class="tabla-contacto-admin">
        <!-- OJO: usamos las mismas clases que en admin/index.php + una extra -->
        <table class="propiedades propiedades-contacto">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Mensaje</th>
                    <th>Tipo Contacto</th>
                    <th>Presupuesto</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($resultContactos && mysqli_num_rows($resultContactos) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($resultContactos)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['telefono']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['mensaje'])) ?></td>
                        <td><?= htmlspecialchars($row['tipo_contacto']) ?></td>
                        <td>$<?= number_format((float)$row['presupuesto'], 2) ?></td>
                        <td><?= htmlspecialchars($row['fecha_contacto']) ?></td>
                        <td><?= htmlspecialchars($row['hora_contacto']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No hay mensajes de contacto todavía.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php
mysqli_close($db);
incluirTemplate('footer');
?>

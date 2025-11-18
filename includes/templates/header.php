<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/bienesraices_inicio/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices_inicio/index.php">
                    <img class="logo-header" src="/bienesraices_inicio/build/img/logo.svg" alt="Logotipo de Bienes Raíces">
                </a>

                <div class="mobile-menu">
                    <img src="/bienesraices_inicio/build/img/barras.svg" alt="Icono Menu Responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/bienesraices_inicio/build/img/dark-mode.svg" alt="Botón Dark Mode">
                    <nav class="navegacion">
                        <a href="/bienesraices_inicio/index.php">Inicio</a>
                        <a href="/bienesraices_inicio/nosotros.php">Nosotros</a>
                        <a href="/bienesraices_inicio/anuncios.php">Anuncios</a>
                        <a href="/bienesraices_inicio/blog.php">Blog</a>
                        <a href="/bienesraices_inicio/contacto.php">Contacto</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</body>
</html>

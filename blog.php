<?php

    require 'includes/funciones.php';


    incluirTemplate('header');
    ?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro Blog
        </h1>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa </h4>
                </a>
                <p>Escrito el: <span>28/02/2025</span> por: <span>Admin</span></p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.hrml">
                    <h4>Guia para la decoracion de tu hogar </h4>
                </a>
                <p>Escrito el: <span>28/02/2025</span> por: <span>Admin</span></p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.hrml">
                    <h4>Terraza en el techo de tu casa </h4>
                </a>
                <p>Escrito el: <span>28/02/2025</span> por: <span>Admin</span></p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.hrml">
                    <h4>Guia para la decoracion de tu hogar </h4>
                </a>
                <p>Escrito el: <span>28/02/2025</span> por: <span>Admin</span></p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            </div>
        </article>

    </main>
    
    <?php
    incluirTemplate ('footer');
    ?>
    
    <script src="build/js/bundle.min.js"></script>
</body>
</html>
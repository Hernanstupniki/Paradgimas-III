<?php

    require 'includes/funciones.php';


    incluirTemplate('header');
    ?>


    <main class="contenedor seccion">
        <h1>Casa en Venta frente al bosque</h1>
        <div class="contenedor contenido-anuncio-propiedad">
            <picture class="imagen-anuncio">
                <source srcset="build/img/destacada.webp" type="image/webp">
                <source srcset="build/img/destacada.jpg" type="image/jpeg">
                    <img loading="lazy" srcset="build/img/destacada.jpg" type="imagen de la propiedad">
            </picture>
    
            <div class="resumen-propiedad">
                <p class="precio">$3,000,000</p>
                <ul class="iconos-propiedades">
                    <li>
                        <img class="icono" src="build/img/icono_wc.svg" alt="icono wc">
                        <p>3</p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p>3</p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                        <p>4</p>
                    </li>
                </ul>   
                    <p class="informacion-propiedad">Eleifend iaculis fusce facilisi etiam justo ante fames, phasellus pharetra vehicula himenaeos egestas praesent auctor congue, fermentum nam arcu suspendisse dis hendrerit. Sem tortor at suscipit pha praesent auctor congue.  praesent auctor congu praesent auctor.</p>
            </div>
        </div>
        <p>
            Lorem ipsum dolor sit amet consectetur adipiscing elit molestie, hendrerit praesent urna in sociis accumsan mi nullam, class sociosqu habitasse phasellus tristique gravida imperdiet. Lobortis enim turpis ligula diam tempor tempus dignissim lacinia, facilisis sociosqu netus cursus odio eget blandit facilisi cras, varius suspendisse maecenas duis vel torquent hendrerit. Etiam suscipit erat habitant in lacus sagittis ridiculus cras nullam curabitur donec, molestie eget metus platea feugiat per est parturient viverra vulputate ullamcorper, auctor quisque taciti blandit pharetra eleifend porta ut pretium luctus.
            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit molestie, hendrerit praesent urna in sociis accumsan mi nullam, class sociosqu habitasse phasellus tristique gravida imperdiet. Lobortis enim turpis ligula diam tempor tempus dignissim lacinia, facilisis sociosqu netus cursus odio eget blandit facilisi cras, varius suspendisse maecenas duis vel torquent hendrerit. Etiam suscipit erat habitant in lacus sagittis ridiculus cras nullam curabitur donec, molestie eget metus platea feugiat per est parturient viverra vulputate ullamcorper, auctor quisque taciti blandit pharetra eleifend porta ut pretium luctus.</p>

        </p>
    </main>

    <?php
    incluirTemplate ('footer');
    ?>
     
    <script src="build/js/bundle.min.js"></script>
</body>
</html>
document.addEventListener("DOMContentLoaded", function () {
    eventListeners();
    darkMode();
    checkBlackBackground();
});

function darkMode() {
    const botonDarkMode = document.querySelector(".dark-mode-boton");

    if (!botonDarkMode) {
        console.error("El botón de dark mode no se encontró");
        return;
    }

    // Detectar si el usuario prefiere modo oscuro
    let preferDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
    if (preferDarkMode.matches) {
        document.body.classList.add("dark-mode");
        setCookie("dark-mode", true, 30);
    } else {
        setCookie("dark-mode", false, 30);
    }

    botonDarkMode.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");
        toggleCookie();
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector(".mobile-menu");

    if (!mobileMenu) {
        console.error("El botón del menú móvil no se encontró");
        return;
    }

    mobileMenu.addEventListener("click", navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector(".navegacion");
    
    if (!navegacion) {
        console.error("El menú de navegación no se encontró");
        return;
    }

    navegacion.classList.toggle("mostrar");
}

// cookies
function checkBlackBackground() {
    if (getValueCookie() == "true") {
        document.body.classList.add("dark-mode");
    }
}

function toggleCookie() {
    if (getValueCookie() == "true") {
        setCookie("dark-mode", false, 30);
    } else {
        setCookie("dark-mode", true, 30);
    }
}

function setCookie(cName, cValue, expDays) {
    let date = new Date();
    date.setTime(date.getTime() + expDays * 24 * 60 * 60 * 1000);
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
}

function getValueCookie() {
    return (document.cookie.match(
        /^(?:.*;)?\s*dark-mode\s*=\s*([^;]+)(?:.*)?$/
    ) || [, null])[1];
}

function propiedadSuccess() {
    const propiedadExito = true; // Simulando que la propiedad fue creada con éxito

    if (propiedadExito) {
        // Aquí se simula la interacción con una variable PHP
        $exito = "propiedad creada correctamente";
    }
}
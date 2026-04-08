let indiceActualGlobal = 0;
let inputsGlobales = [];
let erroresGlobales = 0;
let juegoTerminado = false;
let tiempoInicio = null;
let totalPulsaciones = 0;
let intervaloWPM = null;

document.addEventListener("DOMContentLoaded", () => {
    const btnIniciar = document.getElementById("iniciar");
    if (btnIniciar) btnIniciar.addEventListener("click", iniciarJuego);
});

async function iniciarJuego() {
    const inputMovil = document.getElementById("input-movil");
    const contenedor = document.getElementById("contenedor");
    const teclado = document.getElementById("virtual-keyboard");

    // 1. Configuración del input oculto (Corazón de la versión móvil)
    if (inputMovil) {
        inputMovil.value = " ";
        inputMovil.focus();

        inputMovil.oninput = manejarInputMovil;
        inputMovil.onblur = () => {
            if (!juegoTerminado) setTimeout(() => inputMovil.focus(), 10);
        };
    }

    // Al tocar el contenedor, forzamos foco
    contenedor.onclick = () => inputMovil.focus();

    // 2. Reset de estado y UI
    teclado.style.opacity = "1";
    contenedor.innerHTML = "";
    contenedor.classList.remove("flex-col");
    contenedor.classList.add("flex-wrap");

    // Subir un poco el contenedor en móvil para ganar espacio sobre el teclado
    if (window.innerWidth <= 768) {
        contenedor.style.marginTop = "10px";
    }

    juegoTerminado = false;
    erroresGlobales = 0;
    totalPulsaciones = 0;
    tiempoInicio = null;
    indiceActualGlobal = 0;

    if (intervaloWPM) clearInterval(intervaloWPM);
    document.getElementById("wpm-realtime").innerText = "0";

    // 3. Carga de frases
    let frases = [];
    try {
        const respuesta = await fetch("/js/frases.json");
        const datos = await respuesta.json();
        frases = datos.frases;
    } catch (error) {
        frases = ["Laravel es el framework de PHP para artesanos."];
    }

    const fraseAleatoria = frases[Math.floor(Math.random() * frases.length)];
    const palabras = fraseAleatoria.split(" ");

    // 4. Generación de la estructura de letras
    palabras.forEach((palabra, pIndex) => {
        const wordSpan = document.createElement("span");
        wordSpan.style.display = "inline-block";
        wordSpan.style.whiteSpace = "nowrap";

        palabra.split("").forEach((letra) => {
            wordSpan.appendChild(crearInputLetra(letra));
        });

        contenedor.appendChild(wordSpan);

        if (pIndex < palabras.length - 1) {
            contenedor.appendChild(crearInputLetra(" "));
        }
    });

    inputsGlobales = document.querySelectorAll("#contenedor input");

    // Inicializar resaltado y eventos
    actualizarResaltadoVisual();
    window.onkeydown = handleKeyDown;
}

function crearInputLetra(letra) {
    const input = document.createElement("input");
    input.className = "type-char dark:text-white";
    input.readOnly = true;
    input.dataset.letra = letra;
    input.value = letra === " " ? "\u00A0" : letra;
    if (letra === " ") input.style.borderBottom = "none";
    return input;
}

// --- CAPTURA DE ENTRADA ---

function manejarInputMovil(e) {
    if (juegoTerminado) return;

    const valor = e.target.value;
    // Detectamos si hay algo nuevo después del espacio inicial
    if (valor.length > 1) {
        const letra = valor.substring(valor.length - 1);
        validarPulsacion(letra);
        e.target.value = " "; // Reset inmediato
    }
}

function handleKeyDown(e) {
    if (juegoTerminado) return;

    const letra = e.key;
    if (
        letra === "Shift" ||
        letra === "CapsLock" ||
        letra === "Control" ||
        letra === "Alt"
    )
        return;
    if (letra === "Backspace") return;
    if (letra.length > 1) return;

    // En Desktop prevenimos para que no escriba en el buscador o similar
    if (window.innerWidth > 768) {
        e.preventDefault();
        validarPulsacion(letra);
    }
}

// --- LÓGICA DE JUEGO Y FEEDBACK ---

function validarPulsacion(letraPresionada) {
    if (indiceActualGlobal >= inputsGlobales.length) return;

    if (!tiempoInicio) {
        tiempoInicio = Date.now();
        intervaloWPM = setInterval(actualizarWPMRealTime, 1000);
    }

    const inputActual = inputsGlobales[indiceActualGlobal];
    const letraCorrecta = inputActual.dataset.letra;

    totalPulsaciones++;
    const esCorrecta = letraPresionada === letraCorrecta;
    const teclaVirtual = document.querySelector(
        `.key[data-key="${letraPresionada.toLowerCase()}"]`,
    );

    if (esCorrecta) {
        inputActual.style.color = "#22c55e";
        animarTecla(teclaVirtual, "key-success");
    } else {
        inputActual.style.backgroundColor = "rgba(239, 68, 68, 0.2)";
        inputActual.style.color = "#ef4444";
        animarTecla(teclaVirtual, "key-error");
        erroresGlobales++;
    }

    indiceActualGlobal++;

    // Mover cursor y hacer scroll
    if (indiceActualGlobal < inputsGlobales.length) {
        const siguiente = inputsGlobales[indiceActualGlobal];

        // Auto-Scroll para móvil: centrar la letra activa
        if (window.innerWidth <= 768) {
            siguiente.scrollIntoView({ behavior: "smooth", block: "center" });
        } else {
            siguiente.focus();
        }
        actualizarResaltadoVisual();
    } else {
        actualizarResaltadoVisual(); // Limpiar el último
        finalizarJuego();
    }
}

function actualizarResaltadoVisual() {
    inputsGlobales.forEach((input) => input.classList.remove("letra-activa"));
    if (indiceActualGlobal < inputsGlobales.length) {
        inputsGlobales[indiceActualGlobal].classList.add("letra-activa");
    }
}

// --- FINALIZACIÓN Y CÁLCULOS ---

function finalizarJuego() {
    juegoTerminado = true;
    clearInterval(intervaloWPM);

    const tiempoFinal = Date.now();
    const diferenciaMinutos = (tiempoFinal - tiempoInicio) / 1000 / 60;
    const segundosTotales = Math.floor((tiempoFinal - tiempoInicio) / 1000);

    const grossWPM = totalPulsaciones / 5 / diferenciaMinutos;
    const netWPM = Math.max(0, grossWPM - erroresGlobales / diferenciaMinutos);
    const precision =
        ((totalPulsaciones - erroresGlobales) / totalPulsaciones) * 100;

    let puntosFinales = Math.round(netWPM * 5);
    if (precision >= 95) puntosFinales += 100;
    else if (precision >= 90) puntosFinales += 50;

    document.getElementById("res-wpm").innerText = Math.round(netWPM);
    document.getElementById("res-precision").innerText = Math.round(precision);
    document.getElementById("res-puntos").innerText = puntosFinales;

    const modal = document.getElementById("modal-resultados");
    const content = document.getElementById("modal-content");

    modal.classList.remove("hidden");
    setTimeout(() => {
        content.classList.remove("scale-95", "opacity-0");
        content.classList.add("scale-100", "opacity-100");
    }, 10);

    // Guardar en BD
    fetch("/juegos/save-score", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": window.csrfToken,
        },
        body: JSON.stringify({
            game_id: window.typeSpeedGameId,
            points: puntosFinales,
            time_taken: segundosTotales,
        }),
    });
}

function actualizarWPMRealTime() {
    const ahora = Date.now();
    const diferenciaMinutos = (ahora - tiempoInicio) / 1000 / 60;
    if (diferenciaMinutos > 0) {
        const grossWPM = totalPulsaciones / 5 / diferenciaMinutos;
        const netWPM = Math.round(
            Math.max(0, grossWPM - erroresGlobales / diferenciaMinutos),
        );
        document.getElementById("wpm-realtime").innerText = netWPM;
    }
}

function animarTecla(elemento, clase) {
    if (!elemento) return;
    elemento.classList.add(clase);
    setTimeout(() => elemento.classList.remove(clase), 500);
}

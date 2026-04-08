// public/js/type.js

let indiceActualGlobal = 0;
let inputsGlobales = [];
let erroresGlobales = 0;
let juegoTerminado = false;
let tiempoInicio = null;
let totalPulsaciones = 0;
let intervaloWPM = null;

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("iniciar").addEventListener("click", iniciarJuego);
});

// Forzar el foco al escribir
document.addEventListener("keydown", () => {
    if (
        !juegoTerminado &&
        inputsGlobales.length > 0 &&
        indiceActualGlobal < inputsGlobales.length
    ) {
        inputsGlobales[indiceActualGlobal].focus();
    }
});

async function iniciarJuego() {
    const contenedor = document.getElementById("contenedor");
    const teclado = document.getElementById("virtual-keyboard");
    teclado.style.opacity = "1";
    contenedor.innerHTML = "";
    juegoTerminado = false;
    erroresGlobales = 0;
    totalPulsaciones = 0;
    tiempoInicio = null;

    if (intervaloWPM) clearInterval(intervaloWPM);
    document.getElementById("wpm-realtime").innerText = "0";

    let frases = [];
    try {
        // IMPORTANTE: Ruta absoluta para Laravel
        const respuesta = await fetch("/js/frases.json");
        const datos = await respuesta.json();
        frases = datos.frases;
    } catch (error) {
        console.error("Error cargando frases", error);
        frases = ["Laravel es el framework de PHP para artesanos de la web."];
    }

    const fraseAleatoria = frases[Math.floor(Math.random() * frases.length)];
    const palabras = fraseAleatoria.split(" ");

    contenedor.innerHTML = "";
    contenedor.classList.remove("flex-col"); // Quitamos la dirección de columna del botón
    contenedor.classList.add("flex-wrap"); // Aseguramos que las palabras envuelvan

    palabras.forEach((palabra, pIndex) => {
        // Creamos un contenedor para la palabra que NO se rompa
        const wordSpan = document.createElement("span");
        wordSpan.style.display = "inline-block";
        wordSpan.style.whiteSpace = "nowrap";

        // Creamos los inputs para cada letra de la palabra
        const letras = palabra.split("");
        letras.forEach((letra) => {
            const input = crearInputLetra(letra);
            wordSpan.appendChild(input);
        });

        contenedor.appendChild(wordSpan);

        // Añadimos el espacio después de la palabra (excepto en la última)
        if (pIndex < palabras.length - 1) {
            const espacioInput = crearInputLetra(" ");
            contenedor.appendChild(espacioInput);
        }
    });

    function crearInputLetra(letra) {
        const input = document.createElement("input");
        input.className = "type-char dark:text-white";
        input.readOnly = true;
        input.dataset.letra = letra;
        input.value = letra === " " ? "\u00A0" : letra;
        // Si es espacio, quitamos el borde inferior para que se vea más limpio
        if (letra === " ") input.style.borderBottom = "none";
        return input;
    }

    inputsGlobales = document.querySelectorAll("#contenedor input");
    indiceActualGlobal = 0;

    if (inputsGlobales.length > 0) inputsGlobales[0].focus();

    inputsGlobales.forEach((input) => {
        input.addEventListener("keydown", handleKeyDown);
    });
}

function handleKeyDown(e) {
    if (juegoTerminado) return;
    e.preventDefault();

    // Aviso Bloq Mayús
    const capsLockOn = e.getModifierState("CapsLock");
    document.getElementById("caps-warning").style.display = capsLockOn
        ? "block"
        : "none";

    if (!tiempoInicio) {
        tiempoInicio = Date.now();
        intervaloWPM = setInterval(actualizarWPMRealTime, 1000);
    }

    const letraPresionada = e.key;
    const inputActual = inputsGlobales[indiceActualGlobal];
    const letraCorrecta = inputActual.dataset.letra;

    if (letraPresionada === "Shift" || letraPresionada === "CapsLock") return;
    if (letraPresionada === "Backspace") return;
    if (letraPresionada.length > 1) return;

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

    if (indiceActualGlobal < inputsGlobales.length) {
        inputsGlobales[indiceActualGlobal].focus();
    } else {
        finalizarJuego();
    }
}

function finalizarJuego() {
    juegoTerminado = true;
    clearInterval(intervaloWPM);
    
    const tiempoFinal = Date.now();
    const diferenciaMinutos = (tiempoFinal - tiempoInicio) / 1000 / 60;
    const segundosTotales = Math.floor((tiempoFinal - tiempoInicio) / 1000);

    const grossWPM = totalPulsaciones / 5 / diferenciaMinutos;
    const netWPM = Math.max(0, grossWPM - erroresGlobales / diferenciaMinutos);
    const precision = ((totalPulsaciones - erroresGlobales) / totalPulsaciones) * 100;

    let puntosFinales = Math.round(netWPM * 5);
    if (precision >= 95) puntosFinales += 100;
    else if (precision >= 90) puntosFinales += 50;

    // --- MOSTRAR MODAL EN LUGAR DE ALERT ---
    document.getElementById('res-wpm').innerText = Math.round(netWPM);
    document.getElementById('res-precision').innerText = Math.round(precision);
    document.getElementById('res-puntos').innerText = puntosFinales;

    const modal = document.getElementById('modal-resultados');
    const content = document.getElementById('modal-content');
    
    modal.classList.remove('hidden');
    // Pequeño delay para que la transición de CSS se note
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);

    // Guardar en la base de datos (se mantiene igual)
    fetch("/juegos/save-score", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": window.csrfToken
        },
        body: JSON.stringify({
            game_id: window.typeSpeedGameId,
            points: puntosFinales,
            time_taken: segundosTotales
        })
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

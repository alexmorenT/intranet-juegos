let tiempoRestante = 60.0;
let puntosTotales = 0;
let palabrasAcertadas = 0;
let juegoTerminado = false;
let silabaObjetivo = "";
let intervaloBomba = null;
let diccionarioFull = [];
let palabrasUsadas = [];

document.addEventListener("DOMContentLoaded", () => {
    cargarDiccionario();
    document
        .getElementById("btn-empezar")
        .addEventListener("click", comenzarPartida);
});

async function cargarDiccionario() {
    try {
        const respuesta = await fetch("/js/spanish_full.json");
        const datos = await respuesta.json();
        diccionarioFull = datos.map((item) => limpiarTexto(item.lemma));
        console.log(diccionarioFull);
    } catch (e) {
        console.error("Error", e);
    }
}

function comenzarPartida() {
    document.getElementById("overlay-inicio").classList.add("hidden");
    const input = document.getElementById("input-palabra");
    input.disabled = false;
    input.classList.remove("opacity-50");
    input.placeholder = "¡ESCRIBE!";
    input.focus();

    nuevaSilabaAleatoria();
    iniciarContador();

    input.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            validarPalabra(e.target.value.trim());
        }
    });
}

function nuevaSilabaAleatoria() {
    const palabraBase =
        diccionarioFull[Math.floor(Math.random() * diccionarioFull.length)];
    if (palabraBase.length < 4) return nuevaSilabaAleatoria();

    const longitud = Math.random() > 0.5 ? 3 : 2;
    const inicio = Math.floor(Math.random() * (palabraBase.length - longitud));

    silabaObjetivo = palabraBase
        .substring(inicio, inicio + longitud)
        .toUpperCase();
    document.getElementById("silaba").innerText = silabaObjetivo;
}

function iniciarContador() {
    intervaloBomba = setInterval(() => {
        if (juegoTerminado) return;
        tiempoRestante -= 0.1;
        if (tiempoRestante <= 0) {
            tiempoRestante = 0;
            finalizarJuego();
        }
        document.getElementById("contador-visual").innerText =
            tiempoRestante.toFixed(1);
    }, 100);
}

function limpiarTexto(texto) {
    return texto
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .toLowerCase();
}

function validarPalabra(valor) {
    if (juegoTerminado || valor.length < 1) return;

    const palabraLimpia = limpiarTexto(valor);
    const silabaLimpia = silabaObjetivo.toLowerCase();
    const input = document.getElementById("input-palabra");

    if (
        palabraLimpia.includes(silabaLimpia) &&
        diccionarioFull.includes(palabraLimpia) &&
        !palabrasUsadas.includes(palabraLimpia)
    ) {
        palabrasAcertadas++;
        puntosTotales += valor.length * 10;
        document.getElementById("puntos-realtime").innerText = puntosTotales;
        tiempoRestante = Math.min(tiempoRestante + 3.0, 60.0);

        input.value = "";
        input.classList.add("border-green-500");
        mostrarFeedbackTiempo("+3s");
        nuevaSilabaAleatoria();

        setTimeout(() => input.classList.remove("border-green-500"), 400);
    } else {
        input.classList.add("border-red-500");
        document.getElementById("bomba-body").classList.add("animate-shake");
        setTimeout(() => {
            input.classList.remove("border-red-500");
            document
                .getElementById("bomba-body")
                .classList.remove("animate-shake");
        }, 400);
    }
}

function mostrarFeedbackTiempo(texto) {
    const el = document.getElementById("tiempo-extra");
    el.innerText = texto;
    el.classList.replace("opacity-0", "opacity-100");
    el.classList.add("-translate-y-6");
    setTimeout(() => {
        el.classList.replace("opacity-100", "opacity-0");
        el.classList.remove("-translate-y-6");
    }, 600);
}

function finalizarJuego() {
    juegoTerminado = true;
    clearInterval(intervaloBomba);
    document.getElementById("res-puntos").innerText = puntosTotales;
    document.getElementById("res-intentos").innerText = palabrasAcertadas;
    document.getElementById("modal-resultados").classList.remove("hidden");
    setTimeout(() => {
        document
            .getElementById("modal-content")
            .classList.remove("scale-95", "opacity-0");
        document
            .getElementById("modal-content")
            .classList.add("scale-100", "opacity-100");
    }, 10);
    enviarPuntuacion();
}

async function enviarPuntuacion() {
    fetch("/juegos/save-score", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": window.csrfToken,
        },
        body: JSON.stringify({
            game_id: window.bombPartyGameId,
            points: puntosTotales,
            time_taken: 0,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("res-coins").innerText = "+" + data.coins_earned;
        }
    })
    .catch(err => console.error("Error guardando monedas:", err));
}

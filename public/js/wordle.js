document.addEventListener("DOMContentLoaded", async () => {
    let tiempoInicio = Date.now();
    let diccionarioCompleto = [];
    let palabraObjetivo = "";

    // Cronómetro en tiempo real
    setInterval(() => {
        const timerDisplay = document.getElementById("timer-display");
        if (timerDisplay) {
            const ahora = Date.now();
            const transcurrido = Math.floor((ahora - tiempoInicio) / 1000);
            const mins = String(Math.floor(transcurrido / 60)).padStart(2, "0");
            const segs = String(transcurrido % 60).padStart(2, "0");
            timerDisplay.innerText = `${mins}:${segs}`;
        }
    }, 1000);

    // 1. Cargar diccionario y seleccionar palabra
    async function inicializarDiccionario() {
        try {
            const respuesta = await fetch("/js/spanish.json");
            const datos = await respuesta.json();

            // Guardamos todo en minúsculas para validar
            diccionarioCompleto = datos.map((p) => p.toLowerCase());

            const palabrasValidas = datos.filter((p) => p.length === 5);
            if (palabrasValidas.length === 0)
                throw new Error("No hay palabras de 5 letras");

            const seleccionada =
                palabrasValidas[
                    Math.floor(Math.random() * palabrasValidas.length)
                ];
            palabraObjetivo = seleccionada.toUpperCase();
            console.log("Objetivo para debug:", palabraObjetivo);
        } catch (error) {
            console.error("Error cargando el diccionario:", error);
            palabraObjetivo = "MAREO";
        }
    }

    await inicializarDiccionario();

    const intentos = document.querySelectorAll('[id$="-try"]');
    const todosLosInputs = document.querySelectorAll('[id$="-try"] input');
    let intentoActual = 0;

    // 2. Función para actualizar colores del teclado visual
    function actualizarTecladoEstatus(letra, estado) {
        const tecla = document.getElementById(`key-${letra.toUpperCase()}`);
        if (!tecla) return;

        // Prioridad: Verde > Naranja > Gris
        if (tecla.classList.contains("key-correct")) return;
        if (tecla.classList.contains("key-present") && estado === "grey")
            return;

        // Limpiamos clases previas
        tecla.classList.remove(
            "key-correct",
            "key-present",
            "key-absent",
            "bg-gray-200",
        );

        if (estado === "green") {
            tecla.style.backgroundColor = "#538d4e";
            tecla.classList.add("key-correct");
        } else if (estado === "orange") {
            tecla.style.backgroundColor = "#b59f3b";
            tecla.classList.add("key-present");
        } else if (estado === "grey") {
            tecla.style.backgroundColor = "#3a3a3c";
            tecla.classList.add("key-absent");
        }
        tecla.style.color = "white";
    }

    function activarFila(numeroFila) {
        if (numeroFila < intentos.length) {
            const inputsDeFila = intentos[numeroFila].querySelectorAll("input");
            inputsDeFila.forEach((input) => {
                input.disabled = false;
            });
            inputsDeFila[0].focus();
        }
    }

    // 3. Eventos de entrada (teclado físico)
    todosLosInputs.forEach((element, index) => {
        element.addEventListener("input", (e) => {
            let valor = e.target.value.toUpperCase().replace(/[^A-ZÑ]/g, "");
            e.target.value = valor;
            // Salto al siguiente input
            if (valor !== "" && (index + 1) % 5 !== 0) {
                todosLosInputs[index + 1].focus();
            }
        });

        element.addEventListener("keydown", (e) => {
            // Borrar y volver atrás
            if (
                e.key === "Backspace" &&
                element.value === "" &&
                index % 5 !== 0
            ) {
                todosLosInputs[index - 1].focus();
            }
        });
    });

    // 4. Lógica de procesado de palabra
    async function procesarIntento() {
        if (intentoActual >= intentos.length) return;

        const filaActual = intentos[intentoActual];
        const inputsFila = filaActual.querySelectorAll("input");
        const letrasUsuario = Array.from(inputsFila).map((el) =>
            el.value.toUpperCase(),
        );
        const palabraUsuario = letrasUsuario.join("").toLowerCase();

        if (letrasUsuario.includes("")) return;

        // VALIDACIÓN: ¿Existe la palabra en el JSON?
        if (!diccionarioCompleto.includes(palabraUsuario)) {
            filaActual.classList.add("shake");
            setTimeout(() => filaActual.classList.remove("shake"), 400);
            return;
        }

        // LÓGICA DE COLORES
        let disponible = {};
        for (let letra of palabraObjetivo) {
            disponible[letra] = (disponible[letra] || 0) + 1;
        }

        let estados = new Array(palabraObjetivo.length).fill("grey");

        // Primera pasada: Verdes
        for (let i = 0; i < palabraObjetivo.length; i++) {
            if (letrasUsuario[i] === palabraObjetivo[i]) {
                estados[i] = "green";
                disponible[letrasUsuario[i]]--;
            }
        }

        // Segunda pasada: Naranjas
        for (let i = 0; i < palabraObjetivo.length; i++) {
            if (
                estados[i] !== "green" &&
                disponible[letrasUsuario[i]] > 0 &&
                palabraObjetivo.includes(letrasUsuario[i])
            ) {
                estados[i] = "orange";
                disponible[letrasUsuario[i]]--;
            }
        }

        // Aplicar estilos visuales (Uso de .style para forzar el color sobre el 'disabled')
        inputsFila.forEach((el, i) => {
            el.disabled = true; // Bloqueamos la fila
            el.style.color = "white";

            if (estados[i] === "green") {
                el.style.backgroundColor = "#538d4e";
                el.style.borderColor = "#538d4e";
            } else if (estados[i] === "orange") {
                el.style.backgroundColor = "#b59f3b";
                el.style.borderColor = "#b59f3b";
            } else {
                el.style.backgroundColor = "#3a3a3c";
                el.style.borderColor = "#3a3a3c";
            }

            actualizarTecladoEstatus(letrasUsuario[i], estados[i]);
        });

        const haGanado = estados.every((estado) => estado === "green");

        if (haGanado) {
            const puntos = (6 - intentoActual) * 100;
            setTimeout(
                () => enviarPuntuacion(puntos, "¡Felicidades! Has ganado."),
                500,
            );
        } else {
            intentoActual++;
            if (intentoActual < intentos.length) {
                activarFila(intentoActual);
            } else {
                setTimeout(
                    () =>
                        enviarPuntuacion(
                            0,
                            "Game Over. La palabra era: " + palabraObjetivo,
                        ),
                    500,
                );
            }
        }
    }

    // 5. Envío de datos a Laravel
    function enviarPuntuacion(puntos, mensaje) {
        const tiempoFinal = Date.now();
        const segundosTranscurridos = Math.floor(
            (tiempoFinal - tiempoInicio) / 1000,
        );

        alert(mensaje + "\nTiempo: " + segundosTranscurridos + " segundos.");

        fetch("/juegos/save-score", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.csrfToken,
            },
            body: JSON.stringify({
                game_id: window.wordleGameId,
                points: puntos,
                time_taken: segundosTranscurridos,
            }),
        }).then(() => {
            window.location.href = "/dashboard";
        });
    }

    // Evento ENTER físico
    document.addEventListener("keydown", (e) => {
        if (e.key === "Enter") procesarIntento();
    });

    // Función para el teclado virtual (botones)
    window.manejarClickTeclado = (tecla) => {
        const filaActual = intentos[intentoActual];
        const inputsFilaArray = Array.from(
            filaActual.querySelectorAll("input"),
        );
        const inputVacio = inputsFilaArray.find((input) => input.value === "");

        if (tecla === "ENTER") {
            procesarIntento();
        } else if (tecla === "BORRAR") {
            const ultimoInputConValor = [...inputsFilaArray]
                .reverse()
                .find((input) => input.value !== "");
            if (ultimoInputConValor) {
                ultimoInputConValor.value = "";
                ultimoInputConValor.focus();
            }
        } else {
            if (inputVacio) {
                inputVacio.value = tecla;
                const siguienteIndex = inputsFilaArray.indexOf(inputVacio) + 1;
                if (siguienteIndex < 5) inputsFilaArray[siguienteIndex].focus();
            }
        }
    };

    activarFila(0);
});


document.addEventListener("DOMContentLoaded", function () {
    const data = window.statsData;

    // --- CONFIGURACIÓN GRÁFICO DE RADAR ---
    const ctxRadar = document.getElementById("radarChart");
if (ctxRadar) {
    new Chart(ctxRadar, {
        type: "radar",
        data: {
            labels: [
                "Lógica (Wordle)", 
                "Velocidad (Type)", 
                "Léxico (Bomb)", 
                "Precisión", 
                "Persistencia"
            ],
            datasets: [
                {
                    label: "Mi Perfil",
                    data: [
                        data.wordleAvg, 
                        data.typeSpeedAvg, 
                        data.bombPartyAvg,
                        80, 70 
                    ],
                    backgroundColor: "rgba(99, 102, 241, 0.4)",
                    borderColor: "rgb(99, 102, 241)",
                    borderWidth: 2,
                    pointBackgroundColor: "rgb(99, 102, 241)",
                },
                {
                    label: "Media Empresa",
                    data: [
                        data.globalWordleAvg,
                        data.globalTypeAvg,
                        data.globalBombAvg,
                        60, 55
                    ],
                    backgroundColor: "rgba(156, 163, 175, 0.1)",
                    borderColor: "rgb(156, 163, 175)",
                    borderDash: [5, 5],
                    pointRadius: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    min: 0,
                    max: 100,
                    beginAtZero: true,
                    ticks: {
                        stepSize: 20,
                        display: false
                    },
                    grid: { color: "rgba(156, 163, 175, 0.2)" },
                    angleLines: { color: "rgba(156, 163, 175, 0.2)" },
                    pointLabels: {
                        font: { size: 11, weight: 'bold' },
                        color: '#6B7280'
                    }
                }
            }
        }
    });
}

    // --- CONFIGURACIÓN GRÁFICO DE LÍNEAS ---
    const ctxLine = document.getElementById("lineChart");
    if (ctxLine) {
        new Chart(ctxLine, {
            type: "line",
            data: {
                labels: data.evolucionFechas,
                datasets: [
                    {
                        label: "Puntos Diarios",
                        data: data.evolucionPuntos,
                        borderColor: "rgb(34, 197, 94)",
                        backgroundColor: "rgba(34, 197, 94, 0.1)",
                        tension: 0.4,
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });
    }
});

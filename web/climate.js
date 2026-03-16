


fetch("/api/data.php")
    .then(res => res.json())
    .then(data => {

        const labels = data.map(r => r.dateandtime);
        const temp   = data.map(r => Number(r.temperature));
        const humid  = data.map(r => Number(r.humidity));

        const ctx = document.getElementById("climateChart");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Temperatuur (°C)",
                        data: temp,
                        yAxisID: "yTemp",
                        borderColor: "#ff3b3b",
                        backgroundColor: "transparent",
                        borderWidth: 1.5,
                        tension: 0.2,
                        pointRadius: 0
                    },
                    {
                        label: "Vochtigheid (%)",
                        data: humid,
                        yAxisID: "yHum",
                        borderColor: "#3b82f6",
                        backgroundColor: "transparent",
                        borderWidth: 1.5,
                        tension: 0.2,
                        pointRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: "index",
                    intersect: false
                },
                scales: {
    x: {
        ticks: {
            color: "#e6e6e6",   // neutraal voor tijd
            maxTicksLimit: 8
        },
        grid: {
            color: "#222"
        }
    },

    yTemp: {
        min: -10,
        max: 40,
        type: "linear",
        position: "left",
        title: {
            display: true,
            text: "Temperatuur (°C)",
            color: "#ff3b3b"   // 🔴 rood
        },
        ticks: {
            color: "#ff3b3b"   // 🔴 rood
        },
        grid: {
            color: "#222"
        }        
    },

    yHum: {
        min: 0,
        max: 100,
        type: "linear",
        position: "right",
        title: {
            display: true,
            text: "Vochtigheid (%)",
            color: "#3b82f6"   // 🔵 blauw
        },
        ticks: {
            color: "#3b82f6"   // 🔵 blauw
        },
        grid: {
            drawOnChartArea: false
        }
    }
}

            }
        });
    })
    .catch(err => console.error(err));

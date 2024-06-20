function generarColores(numColores) {
    const colores = [];
    for (let i = 0; i < numColores; i++) {
        const color = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.8)`;
        colores.push(color);
    }
    return colores;
}

document.addEventListener('DOMContentLoaded', function() {
    const canva1 = document.getElementById('diagrama_1');
    const canva2 = document.getElementById('diagrama_2');
    const canva3 = document.getElementById('diagrama_3');

    const colores = generarColores(top_categorias.length);

    const categorias = top_categorias.map(item => item.nombre);
    const totales = top_categorias.map(item => item.total);

    new Chart(canva1, {
        type: 'bar',
        data: {
            labels: categorias,
            datasets: [{
                labels: 'Repeticiones',
                data: totales,
                backgroundColor: colores,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Top 5 Categorías'
                }
            },
        }
    });

    const labels_sexo = Object.keys(suma_por_sexo['M']);
    const dataM = Object.values(suma_por_sexo['M']);
    const dataF = Object.values(suma_por_sexo['F']);

    new Chart(canva2, {
        type: 'bar',
        data: {
            labels: labels_sexo,
            datasets: [{
                labels: 'Hombres',
                data: dataM,
                backgroundColor: 'rgba(54, 162, 235)',
                borderWidth: 1,
                borderRadius: 5
            },
            {
                labels: 'Mujeres',
                data: dataF,
                backgroundColor: 'rgba(255, 99, 132)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    display: true,
                    labels: {
                        generateLabels: function(chart) {
                            return [
                                { text: 'Hombres', fillStyle: 'rgba(54, 162, 235, 0.2)', strokeStyle: 'rgba(54, 162, 235, 1)', lineWidth: 1 },
                                { text: 'Mujeres', fillStyle: 'rgba(255, 99, 132, 0.2)', strokeStyle: 'rgba(255, 99, 132, 1)', lineWidth: 1 }
                            ];
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Categorias por Sexo'
                }
            },
        }
    });

    const labels_salario = Object.keys(promedio_salario);
    const salarios_m = [promedio_salario['18-25']['M'], promedio_salario['26-35']['M'], promedio_salario['36-45']['M'], promedio_salario['46+']['M']];
    const salarios_f = [promedio_salario['18-25']['F'], promedio_salario['26-35']['F'], promedio_salario['36-45']['F'], promedio_salario['46+']['F']];

    new Chart(canva3, {
        type: 'line',
        data: {
            labels: labels_salario,
            datasets: [{
                labels: 'Hombres',
                data: salarios_m,
                backgroundColor: ['rgba(54, 162, 235)'],
                borderColor: 'rgba(54, 162, 235)',
                borderWidth: 5,
                borderRadius: 5
            },
            {
                labels: 'Mujeres',
                data: salarios_f,
                backgroundColor: ['rgba(255, 99, 132)'],
                borderColor: 'rgba(255, 99, 132)',
                borderWidth: 5,
                borderRadius: 5
            }
        ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        generateLabels: function(chart) {
                            return [
                                { text: 'Hombres', fillStyle: 'rgba(54, 162, 235, 0.2)', strokeStyle: 'rgba(54, 162, 235, 1)', lineWidth: 1 },
                                { text: 'Mujeres', fillStyle: 'rgba(255, 99, 132, 0.2)', strokeStyle: 'rgba(255, 99, 132, 1)', lineWidth: 1 }
                            ];
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Expectativa salarial promedio por Edad y Sexo'
                }
            },
        }
    });
});
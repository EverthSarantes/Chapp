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
                        // Definir las etiquetas manualmente
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

    new Chart(canva3, {
        type: 'pie',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                labels: 'Ventas',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ],
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Pie Chart'
                }
            },
        }
    });
});
$(document).ready(function () {
    let myChart = null; // Variable para almacenar la instancia del gráfico

    function updateChart() {
        const fechaInicio = $('#fechaInicio').val();
        const fechaFin = $('#fechaFin').val();

        // Verifica que ambos campos tienen un valor
        if (fechaInicio && fechaFin) {
            $.ajax({
                url: '../../controller/filterAnalytics.php', // Reemplaza con la URL de tu servidor
                type: 'POST',
                data: {
                    dateStart: fechaInicio,
                    dateEnd: fechaFin
                },
                dataType: 'json', // Asegura que la respuesta se trate como JSON
                success: function (response) {
                    // Verifica si la respuesta contiene un error
                    if (response.error) {
                        console.error('Error:', response.error);
                        return;
                    }

                    console.log('Datos recibidos:', response); // Añadido para depuración

                    // Suponiendo que response es un array de objetos con nombreRutina y totalLikes
                    const labels = response.map(item => item.nombreRutina);
                    const data = response.map(item => parseFloat(item.totalLikes));

                    console.log('Etiquetas:', labels); // Añadido para depuración
                    console.log('Datos:', data); // Añadido para depuración

                    // Configura el gráfico
                    const ctx = document.getElementById('myChart').getContext('2d');

                    // Si el gráfico ya existe, destrúyelo antes de crear uno nuevo
                    if (myChart) {
                        myChart.destroy();
                    }

                    // Crea un nuevo gráfico
                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: '# de Likes',
                                data: data,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // Permite ajustar el tamaño del canvas
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 10,
                                    top: 10,
                                    bottom: 10
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    ticks: {
                                        autoSkip: true,
                                        maxRotation: 45,
                                        minRotation: 45
                                    }
                                },
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }
    }

    // Actualiza el gráfico cuando cambie cualquier campo de fecha
    $('#fechaInicio, #fechaFin').on('change', function () {
        updateChart();
    });
});

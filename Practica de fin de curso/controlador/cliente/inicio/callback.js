function callbackEstadisticas(datos) {
    datos = JSON.parse(datos);
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Pedidos", "Albaranes", "Facturas"],
            datasets: [{
                label: "Cantidades",
                data: [datos["pedidos"], datos["albaranes"], datos["facturas"]],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        userCallback: function(label, index, labels) {
                            if (Math.floor(label) === label) {
                                return label;
                            }
                        },
                    }
                }]
            },
        }
    });
}
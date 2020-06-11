var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [{
            label: 'Popularity Score',
            data: [5],
            backgroundColor: [
                        'rgba(255, 99, 132, 0.7)'
                    ],
            borderColor: [
                        'rgba(255,99,132,1)'
                    ],
            borderWidth: 1
                }]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true,
                    suggestedMax: 10,

                }
                    }]
        }
    }
});
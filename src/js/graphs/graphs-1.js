var ctx = document.getElementById("myChart");
    
    
var myDoughnutChart = new Chart(ctx,{
    type: 'doughnut',
    data: {
        labels: ["Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Science Fiction", "TV Movie", "Thriller", "War", "Western", "Romance"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3, 10, 11, 20, 15, 2, 10, 8, 9, 15, 16, 17, 18, 19],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 164, 1)',
                'rgba(111, 10, 205, 1)',
                'rgba(2, 19, 4, 1)',
                'rgba(10, 159, 104, 1)',
                'rgba(25, 159, 64, 1)',
                'rgba(25, 159, 4, 1)',
                'rgba(255, 15, 64, 1)',
                'rgba(105, 19, 64, 1)',
                'rgba(80, 159, 64, 1)',
                'rgba(25, 19, 64, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(109, 109, 100, 1)',
                'rgba(10, 100, 255, 1)',
                'rgba(25, 59, 64, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 164, 1)',
                'rgba(111, 10, 205, 1)',
                'rgba(2, 19, 4, 1)',
                'rgba(10, 159, 104, 1)',
                'rgba(25, 159, 64, 1)',
                'rgba(25, 159, 4, 1)',
                'rgba(255, 15, 64, 1)',
                'rgba(105, 19, 64, 1)',
                'rgba(80, 159, 64, 1)',
                'rgba(25, 19, 64, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(109, 109, 100, 1)',
                'rgba(10, 100, 255, 1)',
                'rgba(25, 59, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    
    options:{
        legend: {
            display: false
         },
    }
});
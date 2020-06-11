$('.owl-carousel').owlCarousel({
    center: true,
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        400: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})
var owl = $('.owl-carousel')
owl.on('changed.owl.carousel', function (e) {
    console.log("current: ", e.item.index) //same
    if (e.item.index == 10) {
        $("#title").text(til1)
        $("#rd").text(rd1)
        $("#bio").text(bio1)
        var ctx = document.getElementById("myChart");
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                //labels: ["Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Science Fiction", "TV Movie", "Thriller", "War", "Western", "Romance"],
                labels: ["Action", "TV Movie", "Romance"],
                datasets: [{
                    data: [50, 50, 50],
                    backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                    borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                    borderWidth: 1
            }]
            },
        });
    } else if (e.item.index == 11) {
        $("#title").text(til2)
        $("#rd").text(rd2)
        $("#bio").text(bio2)
        var ctx = document.getElementById("myChart");
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                //labels: ["Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Science Fiction", "TV Movie", "Thriller", "War", "Western", "Romance"],
                labels: ["Action"],
                datasets: [{
                    data: [50],
                    backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                    borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                    borderWidth: 1
            }]
            },
        });
    } else if (e.item.index == 12) {
        $("#title").text(til3)
        $("#rd").text(rd3)
        $("#bio").text(bio3)
        var ctx = document.getElementById("myChart");
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                //labels: ["Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Science Fiction", "TV Movie", "Thriller", "War", "Western", "Romance"],
                labels: ["Action", "Drama", "War", "Thriller"],
                datasets: [{
                    data: [50, 50, 50, 50],
                    backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                    borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                    borderWidth: 1
            }]
            },
        });
    } else if (e.item.index == 13) {
        $("#title").text(til4)
        $("#rd").text(rd4)
        $("#bio").text(bio4)
        var ctx = document.getElementById("myChart");
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                //labels: ["Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Science Fiction", "TV Movie", "Thriller", "War", "Western", "Romance"],
                labels: ["Action", "Adventure", "TV Movie", "Thriller"],
                datasets: [{
                    data: [50, 50, 50, 50],
                    backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                    borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                    borderWidth: 1
            }]
            },
        });
    } else if (e.item.index == 14) {
        $("#title").text(til5)
        $("#rd").text(rd5)
        $("#bio").text(bio5)
    } else if (e.item.index == 15) {
        $("#title").text(til6)
        $("#rd").text(rd6)
        $("#bio").text(bio6)
    } else if (e.item.index == 16) {
        $("#title").text(til7)
        $("#rd").text(rd7)
        $("#bio").text(bio7)
    } else if (e.item.index == 17) {
        $("#title").text(til8)
        $("#rd").text(rd8)
        $("#bio").text(bio8)
    } else if (e.item.index == 18) {
        $("#title").text(til9)
        $("#rd").text(rd9)
        $("#bio").text(bio9)
    } else if (e.item.index == 19) {
        $("#title").text(til10)
        $("#rd").text(rd10)
        $("#bio").text(bio10)
    } else if (e.item.index == 20) {
        $("#title").text(til11)
        $("#rd").text(rd11)
        $("#bio").text(bio11)
    } else if (e.item.index == 21) {
        $("#title").text(til12)
        $("#rd").text(rd12)
        $("#bio").text(bio12)
    } else if (e.item.index == 22) {
        $("#title").text(til13)
        $("#rd").text(rd13)
        $("#bio").text(bio13)
    } else if (e.item.index == 23) {
        $("#title").text(til14)
        $("#rd").text(rd14)
        $("#bio").text(bio14)
    } else if (e.item.index == 24) {
        $("#title").text(til15)
        $("#rd").text(rd15)
        $("#bio").text(bio15)
    } else if (e.item.index == 25) {
        $("#title").text(til16)
        $("#rd").text(rd16)
        $("#bio").text(bio16)
    } else if (e.item.index == 26) {
        $("#title").text(til17)
        $("#rd").text(rd17)
        $("#bio").text(bio17)
    } else if (e.item.index == 27) {
        $("#title").text(til18)
        $("#rd").text(rd18)
        $("#bio").text(bio18)
    } else if (e.item.index == 28) {
        $("#title").text(til19)
        $("#rd").text(rd19)
        $("#bio").text(bio19)
    } else if (e.item.index == 29) {
        $("#title").text(til20)
        $("#rd").text(rd20)
        $("#bio").text(bio20)
    } else if (e.item.index == 30) {
        $("#title").text(til1)
        $("#rd").text(rd1)
        $("#bio").text(bio1)
    }
})
<?php
//Login Session
session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

//Key used in API maybe make a include document later?
$apikey = "1025f3429a7803a6570aa7e8ebee1ae8";

$db = mysqli_connect("10.169.0.177","whatmovi_mattr","Password1","whatmovi_project");
$sql = $db->query("SELECT * FROM `users` WHERE id = '".$_SESSION['id']."';");
$data = $sql->fetch_array();

//Currently in cinema's
$cn = curl_init();
curl_setopt($cn, CURLOPT_URL, "http://api.themoviedb.org/3/movie/now_playing?api_key=" . $apikey);
curl_setopt($cn, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($cn, CURLOPT_HEADER, FALSE);
curl_setopt($cn, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response6 = curl_exec($cn);
curl_close($cn);
$nowplaying = json_decode($response6);

//Sets loop start at 1
$i = 1;

//Creates Variables for information
foreach($nowplaying->results as $p){
    ${'pic'.$i} = $p->poster_path;
    ${'bio'.$i} = $p->overview;
    ${'rd'.$i} = $p->release_date;
    ${'til'.$i} = $p->title;
    ${'gen'.$i} = $p->genre_ids;
    ${'vote'.$i} = $p->vote_average;
    ${'rel'.$i} = $p->popularity;
  	${'movID'.$i} = $p->id;
    #$keywords = curl_init();
    #curl_setopt($keywords, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$currentIndexID."/keywords?api_key=". $apikey);
    #curl_setopt($keywords, CURLOPT_RETURNTRANSFER, TRUE);
    #curl_setopt($keywords, CURLOPT_HEADER, FALSE);
    #curl_setopt($keywords, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    #$getKeywords = json_decode(curl_exec($keywords));
    #curl_close($keywords);
    #${'key'.$i} = $getKeywords;
    $i = $i + 1;
}
#$currentIndexID = 399579;
#
#curl_setopt($keywords, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$currentIndexID."/keywords?api_key=". $apikey);
#curl_setopt($keywords, CURLOPT_RETURNTRANSFER, TRUE);
#curl_setopt($keywords, CURLOPT_HEADER, FALSE);
#curl_setopt($keywords, CURLOPT_HTTPHEADER, array("Accept: application/json"));
#$getKeywords = json_decode(curl_exec($keywords));
#curl_close($keywords);


?>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Copse" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script src="js/design/prefixfree.min.js"></script>
    
    <!-- Graphs -->
    <script src="js/graphs/Chart.bundle.js"></script>
    <script src="js/graphs/utils.js"></script>

</head>

<body>
    <div class="particles-body">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">WhatMovie</a>
            <button id="collapse" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ranks.php">Ranks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="browse.php">Browse Movies</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <div class="btn-group">
                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account <i class="fa fa-user"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="options.php" class="dropdown-item" style="color:black;">Options</a>
                            <button class="dropdown-item" type="button"><a href="index.php?logout='1'" style="color: red;">Logout</a></button>
                        </div>
                    </div>
                </span>
            </div>
        </nav>
        <div id="particles-js"></div>
        <div class="ms">
            <h1 id="firstMs" class="hidden">Welcome Back Mr. <?php echo $data["lastname"]; ?></h1>
            <h2 id="secondMs" class="hidden">Here are some featured movies for you.</h2>
            <div id="titleMs" class="hidden">
                <h1 class="titleHeader">WhatMovie</h1>
                <p>By Matt Robinson</p>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="owl-carousel owl-theme">
            <?php         
                for ($x = 1; $x <= $i-1; $x++) {
                    echo '<div class="container">
                            <div class="carouselFramed" style="background-image:url(https://image.tmdb.org/t/p/w300'.${'pic'.$x}.');">
                                <div class="overlay">
                                    <div class="text">
                                        <a href="https://www.whatmovie.tk/movie.php?id='.${'movID'.$x}.'">
                                            <p id="respfit" class="hvr-bounce-in">'.${'til'.$x}.'</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row module">
            <div class="col-sm">
                <div>
                    <div>
                        <h1 id="title">
                            <? echo $til1; ?>
                        </h1>
                        <h4 id="rd">
                            <? echo $rd1; ?>
                        </h4>
                    </div>
                    <div>
                        <p id="bio">
                            <? echo $bio1; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <h1 id="title">Average Score</h1>
                <canvas id="vote" width="400" height="80"></canvas>
                <h1 id="title">Relevance</h1>
                <canvas id="relevance" width="400" height="80"></canvas>
                <p><b>NOTE! This is the popularity number, this is based on intensive publicity or promotion.</b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm module">
                <h1 id="title">Keywords</h1>
                <font color="white">
                    This is currently working, although... Due to slow page loading speeds been disabled.

                    If you want proof, ask.
                    <?php
                            #foreach($key1->keywords as $p){
                            #    echo ucfirst('#'.$p->name.'<br>');
                            #}
                        ?>
                </font>
            </div>
            <div class="col-sm module">
                <h1 id="title">Genres</h1>
                <p id="gens">
                    <?
                if (in_array("28", $gen1)){echo "<i class='fas fa-grin-squint-tears'></i> Action<br>";}
                if (in_array("12", $gen1)){echo "<i class='far fa-map'></i> Adventure<br>";}
                if (in_array("16", $gen1)){echo "<i class='fas fa-pencil-ruler'></i> Animation<br>";}
                if (in_array("35", $gen1)){echo "<i class='fas fa-theater-masks'></i> Comedy<br>";}
                if (in_array("80", $gen1)){echo "<i class='fas fa-skull-crossbones'></i> Crime<br>";}
                if (in_array("99", $gen1)){echo "<i class='fas fa-book'></i> Documentary<br>";}
                if (in_array("18", $gen1)){echo "<i class='fas fa-exclamation-triangle'></i> Drama<br>";}
                if (in_array("10751", $gen1)){echo "<i class='fas fa-couch'></i> Family<br>";}
                if (in_array("14", $gen1)){echo "<i class='fas fa-dragon'></i> Fantasy<br>";}
                if (in_array("36", $gen1)){echo "<i class='fas fa-landmark'></i> History<br>";}
                if (in_array("27", $gen1)){echo "<i class='fas fa-ghost'></i> Horror<br>";}
                if (in_array("10402", $gen1)){echo "<i class='fas fa-music'></i> Music<br>";}
                if (in_array("9648", $gen1)){echo "<i class='fas fa-user-secret'></i> Mystery<br>";}
                if (in_array("10749", $gen1)){echo "<i class='fas fa-heart-broken'></i> Romance<br>";}
                if (in_array("878", $gen1)){echo "<i class='fas fa-rocket'></i> Sci-fi<br>";}
                if (in_array("10770", $gen1)){echo "<i class='fas fa-tv'></i> TV-Movie<br>";}
                if (in_array("53", $gen1)){echo "<i class='fas fa-question'></i> Thriller<br>";}
                if (in_array("10752", $gen1)){echo "<i class='fas fa-peace'></i> War<br>";}
                if (in_array("37", $gen1)){echo "<i class='fas fa-horse'></i> Western<br>";}
                ?>
                
                </p>
            </div>
        </div>
        <hr>
        <div class="splitter"></div>
        <div class="row">
            <div class="col-sm module">
                <div>
                    <div>
                        <h1 id="title">A Bit about the website</h1>
                    </div>
                    <div>
                        <p>This website is a movie reccomender based off the baysiens probability structure, as a user inputs more movies as their likes and dislikes this increases the probibility of the algorithm reccomending a movie that's relivent to the user. <br><br> This website is coded purely in HTML, Javascript and PHP.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-8 col-md-6" style="text-align: left;">
                    <h5>WhatMovie.tk</h5>
                </div>
                <div class="col-2 col-md-3" style="text-align: right;">Contact</div>
                <div class="col-2 col-md-3" style="text-align: right;">Created By Matt Robinson</div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script src='js/dependencies/jquery-3.3.1.min.js'></script>
    
    <script src='js/header/particles.min.js'></script>
    <script src="js/header/particlescfg.js"></script>

    <script src='js/design/jquery.min.js'></script>
    <script src="js/design/slider.js"></script>

    <!-- Owl Carousel -->
    <script src="js/carousel/owl.carousel.min.js"></script>
    <script>
        var ctx = document.getElementById("vote").getContext('2d');
        var vote = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                datasets: [{
                    label: 'Average Vote Score',
                    data: [<? echo $vote1; ?>],
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
    </script>
    <script>
        var ctx = document.getElementById("relevance").getContext('2d');
        var relevance = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                datasets: [{
                    label: 'Relevance',
                    data: [<? echo $rel1; ?>],
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
                            suggestedMax: 1000,

                        }
                    }]
                }
            }
        });
    </script>
    <script>
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
        owl.on('changed.owl.carousel', function(e) {
            console.log("current: ", e.item.index) //same
            //Checks for index
            if (e.item.index == 10) {
                $("#title").text("<? echo(str_replace('"',"",$til1)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd1)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio1)); ?>")
                $("#gens").text("")
                
                //Sets Graph
                vote.data.datasets[0].data[0] = <? echo $vote1; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel1; ?>;
                relevance.update();
                
                <?                 
                if (in_array("28", $gen1)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen1)){echo "$('#gens').append('<i class=\"far fa-map\"></i> Adventure<br>')\n";}
                if (in_array("16", $gen1)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen1)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen1)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen1)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen1)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen1)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen1)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen1)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen1)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen1)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen1)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen1)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen1)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen1)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen1)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen1)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen1)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 11) {
                $("#title").text("<? echo(str_replace('"',"",$til2)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd2)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio2)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote2; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel2; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen2)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen2)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen2)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen2)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen2)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen2)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen2)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen2)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen2)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen2)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen2)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen2)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen2)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen2)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen2)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen2)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen2)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen2)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen2)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 12) {
                $("#title").text("<? echo(str_replace('"',"",$til3)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd3)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio3)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote3; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel3; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen3)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen3)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen3)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen3)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen3)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen3)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen3)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen3)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen3)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen3)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen3)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen3)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen3)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen3)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen3)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen3)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen3)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen3)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen3)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 13) {
                $("#title").text("<? echo(str_replace('"',"",$til4)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd4)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio4)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote4; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel4; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen4)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen4)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen4)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen4)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen4)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen4)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen4)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen4)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen4)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen4)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen4)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen4)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen4)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen4)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen4)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen4)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen4)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen4)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen4)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 14) {
                $("#title").text("<? echo(str_replace('"',"",$til5)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd5)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio5)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote5; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel5; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen5)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen5)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen5)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen5)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen5)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen5)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen5)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen5)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen5)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen5)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen5)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen5)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen5)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen5)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen5)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen5)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen5)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen5)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen5)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 15) {
                $("#title").text("<? echo(str_replace('"',"",$til6)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd6)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio6)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote6; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel6; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen6)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen6)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen6)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen6)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen6)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen6)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen6)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen6)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen6)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen6)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen6)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen6)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen6)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen6)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen6)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen6)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen6)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen6)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen6)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 16) {
                $("#title").text("<? echo(str_replace('"',"",$til7)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd7)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio7)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote7; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel7; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen7)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen7)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen7)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen7)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen7)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen7)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen7)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen7)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen7)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen7)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen7)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen7)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen7)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen7)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen7)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen7)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen7)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen7)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen7)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 17) {
                $("#title").text("<? echo(str_replace('"',"",$til8)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd8)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio8)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote8; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel8; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen8)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen8)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen8)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen8)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen8)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen8)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen8)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen8)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen8)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen8)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen8)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen8)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen8)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen8)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen8)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen8)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen8)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen8)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen8)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 18) {
                $("#title").text("<? echo(str_replace('"',"",$til9)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd9)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio9)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote9; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel9; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen9)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen9)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen9)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen9)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen9)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen9)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen9)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen9)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen9)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen9)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen9)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen1)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen9)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen9)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen9)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen9)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen9)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen9)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen9)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 19) {
                $("#title").text("<? echo(str_replace('"',"",$til10)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd10)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio10)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote10; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel10; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen10)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen10)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen10)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen10)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen10)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen10)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen10)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen10)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen10)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen10)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen10)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen10)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen10)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen10)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen10)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen10)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen10)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen10)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen10)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 20) {
                $("#title").text("<? echo(str_replace('"',"",$til11)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd11)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bi11)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote11; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel11; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen11)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen11)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen11)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen11)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen11)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen11)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen11)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen11)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen11)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen11)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen11)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen11)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen11)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen11)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen11)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen11)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen11)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen11)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen11)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen11)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 21) {
                $("#title").text("<? echo(str_replace('"',"",$til12)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd12)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio12)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote12; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel12; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen12)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen12)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen12)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen12)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen12)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen12)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen12)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen12)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen12)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen12)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen12)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen12)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen12)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen12)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen12)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen12)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen12)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen12)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen12)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen12)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 22) {
                $("#title").text("<? echo(str_replace('"',"",$til13)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd13)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio13)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote13; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel13; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen13)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen13)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen13)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen13)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen13)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen13)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen13)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen13)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen13)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen13)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen13)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen13)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen13)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen13)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen13)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen13)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen13)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen13)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen13)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen13)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 23) {
                $("#title").text("<? echo(str_replace('"',"",$til14)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd14)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio14)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote14; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel14; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen14)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen14)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen14)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen14)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen14)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen14)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen14)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen14)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen14)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen14)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen14)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen14)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen14)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen14)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen14)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen14)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen14)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen14)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen14)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen14)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 24) {
                $("#title").text("<? echo(str_replace('"',"",$til15)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd15)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio15)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote15; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel15; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen15)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen15)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen15)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen15)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen15)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen15)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen15)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen15)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen15)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen15)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen15)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen15)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen15)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen15)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen15)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen15)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen15)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen15)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen15)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen15)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 25) {
                $("#title").text("<? echo(str_replace('"',"",$til16)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd16)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio16)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote16; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel16; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen16)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen16)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen16)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen16)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen16)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen16)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen16)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen16)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen16)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen16)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen16)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen16)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen16)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen16)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen16)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen16)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen16)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen16)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen16)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen16)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 26) {
                $("#title").text("<? echo(str_replace('"',"",$til17)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd17)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio17)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote17; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel17; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen17)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen17)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen17)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen17)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen17)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen17)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen17)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen17)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen17)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen17)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen17)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen17)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen17)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen17)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen17)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen17)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen17)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen17)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen17)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen17)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 27) {
                $("#title").text("<? echo(str_replace('"',"",$til18)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd18)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio18)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote18; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel18; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen18)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen18)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen18)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen18)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen18)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen18)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen18)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen18)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen18)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen18)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen18)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen18)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen18)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen18)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen18)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen18)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen18)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen18)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen18)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen18)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 28) {
                $("#title").text("<? echo(str_replace('"',"",$til19)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd19)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio19)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote19; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel19; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen19)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen19)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen19)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen19)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen19)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen19)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen19)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen19)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen19)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen19)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen19)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen19)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen19)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen19)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen19)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen19)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen19)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen19)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen19)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen19)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 29) {
                $("#title").text("<? echo(str_replace('"',"",$til20)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd20)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio20)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote20; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel20; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen20)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen20)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen20)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen20)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen20)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen20)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen20)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen20)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen20)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen20)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen20)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen20)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen20)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen20)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen20)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen20)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen20)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen20)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen20)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen20)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            } else if (e.item.index == 30) {
                $("#title").text("<? echo(str_replace('"',"",$til1)); ?>")
                $("#rd").text("<? echo(str_replace('"',"",$rd1)); ?>")
                $("#bio").text("<? echo(str_replace('"',"",$bio1)); ?>")
                $("#gens").text("")
                vote.data.datasets[0].data[0] = <? echo $vote1; ?>;
                vote.update();
                
                relevance.data.datasets[0].data[0] = <? echo $rel1; ?>;
                relevance.update();
                <? 
                #if (in_array("12", $gen1)){echo "$('#gens').append('<img style=\"width: 25%; height: 25%;\" src=\"images/genres/adventure.svg\" />Adventure<br> ')\n";}
                if (in_array("28", $gen1)){echo "$('#gens').append('<i class=\"fas fa-exclamation-triangle\"></i> Action<br>')\n";}
                if (in_array("12", $gen1)){echo "$('#gens').append('<i class=\'far fa-map\'></i> Adventure<br>')\n";}
                if (in_array("16", $gen1)){echo "$('#gens').append('<i class=\"fas fa-pencil-ruler\"></i> Animation<br>')\n";}
                if (in_array("35", $gen1)){echo "$('#gens').append('<i class=\"fas fa-grin-squint-tears\"></i> Comedy<br>')\n";}
                if (in_array("80", $gen1)){echo "$('#gens').append('<i class=\"fas fa-skull-crossbones\"></i> Crime<br>')\n";}
                if (in_array("99", $gen1)){echo "$('#gens').append('<i class=\"fas fa-book\"></i> Documentary<br>')\n";}
                if (in_array("18", $gen1)){echo "$('#gens').append('<i class=\"fas fa-theater-masks\"></i> Drama<br>')\n";}
                if (in_array("10751", $gen1)){echo "$('#gens').append('<i class=\"fas fa-couch\"></i> Family<br>')\n";}
                if (in_array("14", $gen1)){echo "$('#gens').append('<i class=\"fas fa-dragon\"></i> Fantasy<br>')\n";}
                if (in_array("36", $gen1)){echo "$('#gens').append('<i class=\"fas fa-landmark\"></i> History<br>')\n";}
                if (in_array("27", $gen1)){echo "$('#gens').append('<i class=\"fas fa-ghost\"></i> Horror<br>')\n";}
                if (in_array("10402", $gen1)){echo "$('#gens').append('<i class=\"fas fa-music\"></i> Music<br>')\n";}
                if (in_array("9648", $gen1)){echo "$('#gens').append('<i class=\"fas fa-user-secret\"></i> Mystery<br>')\n";}
                if (in_array("10749", $gen1)){echo "$('#gens').append('<i class=\"fas fa-heart-broken\"></i> Romance<br>')\n";}
                if (in_array("878", $gen1)){echo "$('#gens').append('<i class=\"fas fa-rocket\"></i> Sci-fi<br>')\n";}
                if (in_array("10770", $gen1)){echo "$('#gens').append('<i class=\"fas fa-tv\"></i> TV-Movie<br>')\n";}
                if (in_array("53", $gen1)){echo "$('#gens').append('<i class=\"fas fa-question\"></i> Thriller<br>')\n";}
                if (in_array("10752", $gen1)){echo "$('#gens').append('<i class=\"fas fa-peace\"></i> War<br>')\n";}
                if (in_array("37", $gen1)){echo "$('#gens').append('<i class=\"fas fa-horse\"></i> Western<br>')\n";}
                ?>
            }
        })
    </script>
    
    <!-- Messages -->
    <script src="js/header/popupmsg.js"></script>
    
    <script src="js/dependencies/jquery-3.3.1.min.js"></script>
    <script src="js/resptext/jquery.fittext.js"></script>
    <script type="text/javascript">
		$("#respfit").fitText(1.5);
        $("#gens").fitText(1.8);
	</script>
    -->
</body>

</html>
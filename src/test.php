<?php
include 'dbc.php';
$apikey = "1025f3429a7803a6570aa7e8ebee1ae8";
$sql = $connection->query("SELECT * FROM `users` WHERE ID = '64';");
if($sql->num_rows > 0){
    $data = $sql->fetch_array();
    $usrCounter = $data["usrCounter"];
    $cPage = $data["cPage"];
} else {
    $data = $sql->fetch_array(); 
    $usrCounter = 0;
    $cPage = 1;
    $sql = $connection->query("UPDATE users SET usrCounter='0', cPage='1' WHERE id='64'");
}
$rated = curl_init();
curl_setopt($rated, CURLOPT_URL, "https://api.themoviedb.org/3/discover/movie?api_key=".$apikey."&language=en-US&sort_by=vote_count.desc&include_adult=false&include_video=false&page=".$cPage."&with_original_language=en");
curl_setopt($rated, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($rated, CURLOPT_HEADER, FALSE);
curl_setopt($rated, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$ratedMovies = json_decode(curl_exec($rated));
curl_close($rated);
$topRatedResults = $ratedMovies->results;

#Get Reviews
$reviews = curl_init();
curl_setopt($reviews, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$topRatedResults[$usrCounter]->id."/reviews?api_key=". $apikey);
curl_setopt($reviews, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($reviews, CURLOPT_HEADER, FALSE);
curl_setopt($reviews, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$getReviews = json_decode(curl_exec($reviews));
curl_close($reviews);
$firstReview = $getReviews->results[0];

var_dump($firstReview);

$sql = $connection->query("SELECT * FROM `moviedata` WHERE movieID = '".$topRatedResults[$usrCounter]->id."';");
if($sql->num_rows < 1){
    $sql = $connection->query("INSERT INTO movieData (movieID, movieName, release_date, genre_id, popularity_rating, vote_average, vote_count)
    VALUES ('".$topRatedResults[$usrCounter]->id."','".$topRatedResults[$usrCounter]->title."','".$topRatedResults[$usrCounter]->release_date."','','".$topRatedResults[$usrCounter]->popularity."','".$topRatedResults[$usrCounter]->vote_average."','".$topRatedResults[$usrCounter]->vote_count."');");
}
$poster = "https://image.tmdb.org/t/p/w300".$topRatedResults[$usrCounter]->poster_path;
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Copse" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="js/design/prefixfree.min.js"></script>
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="ranks.php">Ranks<span class="sr-only">(current)</span></a>
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
            <div id="titleMs" class="hidden">
                <h1 class="titleHeader">WhatMovie</h1>
                <p>By Matt Robinson</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h1>Your Personalised Library</h1>
        </div>
        <hr>
        <div class="splitter-s"></div>
    </div>
    
    
    <div class="model">
        <div class="container">
            <div class="row">
                <div id="grid-container" class="grid-container">
                    <div id="poster" class="item1">
                        <img src="<?php echo $poster;?>"></div>
                    <div id ="information" class="item2">
                        <h1><?php echo $topRatedResults[$usrCounter]->title ?></h1>
                        <p><?php echo $topRatedResults[$usrCounter]->release_date ?></p>
                        <p><?php echo $topRatedResults[$usrCounter]->overview ?></p>
                    </div>
                    <div class="item3">
                        <div class="sliderContainer">
                            <p>Input a value in which you think is appropriate to the movie. <b>Keep it consistent!</b></p>
                            <input name="name_entered" type="range" min="1" max="100" value="50" class="slider" id="name_entered">
                            <p>Value: <span style="color:#FFD700;" id="value"></span></p>
                            <input type="submit" class="btn btn-outline-dark" value="Submit" onclick="insertUserData()" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
	
	<div class="container">
        <div class="row">
            <div class="col-sm module overflowRating">
                <div>
                    <div>
                        <h1 id="title">Comments</h1>
                    </div>
                    <div class="splitter-s">
                        <p style="text-align: left; margin-left: 5px;"><b>Most Recent Comment: </b></p>
                        <?php
                        if (empty($firstReview->content) && is_null($firstReview->content)){
				                echo stripslashes('We found no reviews! If you\'ve watched this movie before, help out the community and give it a rating!');
                            } else {
				                echo '<h4 style="text-align: left; margin-left: 5px;">'.$firstReview->content.'</h4>';
                                echo '<div class="splitter-s"></div>';
                                echo '<h6 style="text-align: left; margin-left: 5px;"><u>Written by '.$firstReview->author.'</u></h6>';
                                echo '<div class="splitter-s"></div>';
                                echo '<p><a href="'.$firstReview->url.'" target="_blank">View the full link here.</a></p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
			
			
			
			
            <div class="col-sm module">
                <div>
                    <div>
                        <h1 id="title">Here are some graphs!</h1>
                    </div>
                    <div class="splitter-s">
                        <h3>Vote Average</h3>
                        <canvas id="vote" width="400" height="80"></canvas>
                    </div>
                    <div>
                        <h3>Relevance</h3>
                        <canvas id="relevance" width="400" height="80"></canvas>
                        <p><b>NOTE! This number is higher when a movie has been recently released.</b></p>
                    </div>
                    <div>
                        <canvas id="totalVotes" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="splitter"></div>
        <div class="row">
            <h4>Here are some things I think you may like:</h4>
        </div>
    </div>
	<hr>
    <div id="ratings"></div>
    <input type="submit" class="btn btn-primary" value="Refresh Movies" onclick="refreshmovies()" />
    <br><br>
</body>
    <!-- Bootstrap Required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Sliders -->
    <script src="js/slider/scroller.js"></script>

    <!-- Messages -->
    <script src="js/header/popupmsgDefault.js"></script>

    <script src='js/dependencies/jquery-3.3.1.min.js'></script>
    <script src='js/header/particles.min.js'></script>
    <script src="js/header/particlescfg.js"></script>

    <script src="js/design/slider.js"></script>

    <script>
        function insertUserData() { 
            var request;
            try {
                request = new XMLHttpRequest();
            } catch (tryMicrosoft) {
                try {
                    request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (otherMicrosoft) {
                    try {
                        request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (failed) {
                        request = null;
                    }
                }
            }
            var url = "insert.php";
            var person_name = document.getElementById("name_entered").value;
            var vars = "name=" + person_name;
            request.open("POST", url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var return_data = request.responseText;
                    $('#poster').remove();
                    $('#information').remove();
                    $("#grid-container").prepend(return_data);
                }
            }
            request.send(vars);
        }
    </script>
    <script>
        function refreshmovies() {
            var request;
            try {
                request = new XMLHttpRequest();
            } catch (tryMicrosoft) {
                try {
                    request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (otherMicrosoft) {
                    try {
                        request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (failed) {
                        request = null;
                    }
                }
            }
            var url = "refresh.php";
            var person_name = document.getElementById("name_entered").value;
            var vars = "name=" + person_name;
            request.open("POST", url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var return_data = request.responseText;
                    document.getElementById("ratings").innerHTML = return_data;
                }
            }
            request.send(vars);
        }
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
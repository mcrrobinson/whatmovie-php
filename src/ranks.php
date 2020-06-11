<?php
#Login Session
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

#Key used in API maybe make a include document later?
$apikey = "1025f3429a7803a6570aa7e8ebee1ae8";

//Connect to server.
$db = mysqli_connect("10.169.0.177","whatmovi_mattr","Password1","whatmovi_project");
//Retrieve data from server.
$sql = $db->query("SELECT * FROM `users` WHERE id = '".$_SESSION['id']."';");
//If the user is existing.
if($sql->num_rows > 0){
    $data = $sql->fetch_array();
    $usrCounter = $data["usrCounter"];
    $page = $data["cPage"];
    echo "<p style='color: white;'>Debugging, retrieved data: ".$_SESSION['id']."</p>";
    echo "User Counter: ".$usrCounter;
//If the user is new.
} else {
    $usrCounter = 0;
    $page = 1;
    $sql = $db->query("UPDATE users SET usrCounter='0', cPage='1' WHERE id='".$_SESSION['id']."'");    
    $sql = $db->query("INSERT INTO userInfo (id, movieID, movieRating)
        VALUES ('".$_SESSION["id"]."','','');");
    echo "Debugging, entered data: ".$_SESSION['id'];
}

#Top rated movies
$rated = curl_init();
curl_setopt($rated, CURLOPT_URL, "https://api.themoviedb.org/3/discover/movie?api_key=".$apikey."&language=en-US&sort_by=vote_count.desc&include_adult=false&include_video=false&page=".$page."&with_original_language=en");
curl_setopt($rated, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($rated, CURLOPT_HEADER, FALSE);
curl_setopt($rated, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$ratedMovies = json_decode(curl_exec($rated));
curl_close($rated);
$counterArray = $ratedMovies->results;

//Request information on the movie under current ID.
$sql = $db->query("SELECT * FROM `movieData` WHERE id = '".$counterArray[$usrCounter]->id."';");
//If no replies make a entry in database.
if($sql->num_rows < 1){
    $sql = $db->query("INSERT INTO movieData (movieID, movieName, release_date, genre_id, popularity_rating, vote_average, vote_count)
    VALUES ('".$counterArray[$usrCounter]->id."','".$counterArray[$usrCounter]->title."','".$counterArray[$usrCounter]->release_date."','','".$counterArray[$usrCounter]->popularity."','".$counterArray[$usrCounter]->vote_average."','".$counterArray[$usrCounter]->vote_count."');");
//If movie exists in database., do nothing.
} else {
    
}
//if (isset($_POST['submit'])) {
//    //Setting new count plus one.
//    $usrCounter = $usrCounter + 1;
//    $sql = $db->query("UPDATE users SET usrCounter='".$usrCounter."' WHERE id='".$_SESSION['id']."';");
//    
//    //If data exists overwrite it. If not insert it.
//    $sql = $db->query("SELECT * FROM `userInfo` WHERE id = '".$_SESSION['id']."';");
//    $data = $sql->fetch_array();
//    
//    
//    echo '<p style="color: white;">First ID: '.$data["movieID"].'</h1>';
//    echo '<p style="color: white;">Movie ID: '.$counterArray[$usrCounter]->id.'</h1>';
//    
//    
//    if ($data->movieID == $counterArray[$usrCounter]->id){
//        $sql = $db->query("UPDATE userInfo SET id='".$_SESSION['id']."', movieID='".$counterArray[$usrCounter]->id."', movieRating='".$_POST['slider']."' WHERE id=".$_SESSION['id'].";");
//    } else {
//        $sql = $db->query("INSERT INTO userInfo (id, movieID, movieRating)
//        VALUES ('".$_SESSION['id']."','".$counterArray[$usrCounter]->id."','".$_POST['slider']."');");
//        echo '<p style="color: white;">ENTERED</h1>';
//    }
//    
//    //if($sql->num_rows > 0){
//    //    $sql = $db->query("UPDATE userInfo SET id='".$_SESSION['id']."', movieID='".$counterArray[$usrCounter]->id."', movieRating='".$_POST['slider']."' WHERE id=".$_SESSION['id'].";");
//    //} else {
//    //    $sql = $db->query("INSERT INTO userInfo (id, movieID, movieRating)
//    //    VALUES ('".$_SESSION['id']."','".$counterArray[$usrCounter]->id."','".$_POST['slider']."');");
//    //} 
//    
//    //If movie data doesn't exist, create it.
//    $sql = $db->query("SELECT * FROM `movieData` WHERE id = '".$counterArray[$usrCounter]->id."';");
//    if($sql->num_rows < 1){
//        $sql = $db->query("INSERT INTO movieData (movieID, movieName, release_date, genre_id, popularity_rating, vote_average, vote_count)
//        VALUES ('".$counterArray[$usrCounter]->id."','".$counterArray[$usrCounter]->title."','".$counterArray[$usrCounter]->release_date."','','".$counterArray[$usrCounter]->popularity."','".$counterArray[$usrCounter]->vote_average."','".$counterArray[$usrCounter]->vote_count."');");
//    } else {
//        
//    }
//}

//Goes back to the previous movie.
if(array_key_exists('prev',$_POST)){
    if($usrCounter == 0){
        //Once at the begining of the array go back to previous array.
        $page = $page - 1;
        $sql = $db->query("UPDATE users SET cPage='$page' WHERE id='".$_SESSION['id']."'");
        $usrCounter =  19;
        $sql = $db->query("UPDATE users SET usrCounter='$usrCounter' WHERE id='".$_SESSION['id']."'");
    } else {
        //Set counter to go back to previous display.
        $usrCounter = $usrCounter - 1;
        $sql = $db->query("UPDATE users SET usrCounter='$usrCounter' WHERE id='".$_SESSION['id']."'");
        echo "This movie ID is: ".$counterArray[$usrCounter]->id.". Your last rating was: ".$_POST['slider'].". Your current counter is on: ".$usrCounter.". You're on page: ".$page;
    }
}

//Submit movie.
if(array_key_exists('submit',$_POST)){
    //Request user data on movie ID entered.
    $sql = $db->query("SELECT * FROM `userInfo` WHERE id = '".$_SESSION['id']."' AND movieID = '".$counterArray[$usrCounter]->id."';");
    $data = $sql->fetch_array();
    //If there is no data, insert it into the database.
    if(!$data){
        $sql = $db->query("INSERT INTO userInfo (id, movieID, movieRating)
VALUES ('".$_SESSION['id']."', '".$counterArray[$usrCounter]->id."', '".$_POST['slider']."');");
    //Else the data exists, update it.
    } else {
        $sql = $db->query("UPDATE userInfo
SET movieRating = ".$_POST['slider']."
WHERE movieID = ".$counterArray[$usrCounter]->id." AND id=".$_SESSION['id'].";");
    }
    
    if($usrCounter == 19){
        $usrCounter = 0;
        $sql = $db->query("UPDATE users SET usrCounter='$usrCounter' WHERE id='".$_SESSION['id']."'");
        $page = $page + 1;
        $sql = $db->query("UPDATE users SET cPage='$page' WHERE id='".$_SESSION['id']."'");
    } else {
        //Adds a one to the counter.
        $usrCounter = $usrCounter + 1;
        //Updates the database with the new counter.
        $sql = $db->query("UPDATE users SET usrCounter='$usrCounter' WHERE id='".$_SESSION['id']."'");
    }
    
    echo "This movie ID is: ".$counterArray[$usrCounter]->id.". Your last rating was: ".$_POST['slider'].". Your current counter is on: ".$usrCounter.". You're on page: ".$page;
}

//Skips movie.
if(array_key_exists('skip',$_POST)){
    $usrCounter = $usrCounter + 1;
    $sql = $db->query("UPDATE users SET usrCounter='$usrCounter' WHERE id='".$_SESSION['id']."'");
    echo "This movie ID is: ".$counterArray[$usrCounter]->id.". Your last rating was: ".$_POST['slider'].". Your current counter is on: ".$usrCounter.". You're on page: ".$page;
}


#Get Reviews
$reviews = curl_init();
curl_setopt($reviews, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$counterArray[$usrCounter]->id."/reviews?api_key=". $apikey);
curl_setopt($reviews, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($reviews, CURLOPT_HEADER, FALSE);
curl_setopt($reviews, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$getReviews = json_decode(curl_exec($reviews));
curl_close($reviews);
$firstReview = $getReviews->results[0];
//Similar Movies
$cs = curl_init();
curl_setopt($cs, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$counterArray[$usrCounter]->id."/similar?api_key=" . $apikey);
curl_setopt($cs, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($cs, CURLOPT_HEADER, FALSE);
curl_setopt($cs, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response9 = curl_exec($cs);
curl_close($cs);
$movie_similar_id = json_decode($response9);

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
                <div class="col-sm">
                    <div class="splitter-s"></div>
                    <?php
                    echo '<h1 id="title">'.$counterArray[$usrCounter]->title.'</h1>';
                    echo '<h4 id="bio">'.$counterArray[$usrCounter]->release_date.'</h4>';
                    echo '<p>'.$counterArray[$usrCounter]->overview.'</p>';
                    ?>
                    <div class="slidecontainer">
                        <form method="POST" action='ranks.php'>
                            <p>Input a value in which you think is appropriate to the movie. <b>Keep it consistent!</b></p>
                            <input name="slider" type="range" min="1" max="100" value="50" class="slider" id="myRange">
                            <p>Value: <span style="color:#FFD700;" id="value"></span></p>
                            <input <? if($usrCounter < 1 and $page = 0){ echo 'disabled'; } ?> name="prev" id="prev" type="submit" class="btn btn-outline-dark" value="⇦ Prev" />
                            <button type="submit" name="submit" class="btn btn-outline-dark">Submit</button>
                            <input name="skip" id="skip" type="submit" class="btn btn-outline-dark" value="Skip ⇨" />
                        </form>
                    </div>
                </div>
                <?
                echo '<img src="https://image.tmdb.org/t/p/w300'.$counterArray[$usrCounter]->poster_path.'">';
                ?>
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
        <hr>
        <p>You will be unable to get ranked movies until you have rated atleast 20.</p>
        <div class="splitter-s"></div>
        <div class="row">
            <?php
                $rowCounter = 0;
                foreach($movie_similar_id->results as $results) {
                    $title = $results->title;
                    $id = $results->id;
                    $release = $results->release_date;
                    if($rowCounter == 4){
                        echo '</div>';
                        echo '<div class="row">';
                    }
                    echo '<div class="col-sm module">';
                    $backdrop = $results->poster_path;
                    if (empty($backdrop) && is_null($backdrop)){
				        $backdrop =  '/images/no-gambar.jpg';
                    } else {
				        $backdrop = 'https://image.tmdb.org/t/p/w300'.$backdrop;
                    }
                    echo '<a href="movie.php?id=' . $id . '"><div class="imageFramed" style="background-image:url('.$backdrop.');">';
                    echo '<h4 class="centered">'.$title.'</h4></div></a>';
					echo '</div>';
                    if($rowCounter == 4){
                        $rowCounter = 0;
                    }
                    $rowCounter = $rowCounter + 1;
				}
                    
            ?>
        </div>
        <div class="splitter-s"></div>
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

    <!-- Sliders -->
    <script src="js/slider/scroller.js"></script>

    <!-- Messages -->
    <script src="js/header/popupmsgDefault.js"></script>

    <script src='js/dependencies/jquery-3.3.1.min.js'></script>
    <script src='js/header/particles.min.js'></script>
    <script src="js/header/particlescfg.js"></script>

    <script src='js/design/jquery.min.js'></script>
    <script src="js/design/slider.js"></script>
    <script>
        var ctx = document.getElementById("vote").getContext('2d');
        var vote = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                datasets: [{
                    label: 'Average Vote Score',
                    data: [<? echo $counterArray[$usrCounter]->vote_average; ?>],
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
                    data: [<? echo $counterArray[$usrCounter]->popularity; ?>],
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
                            suggestedMax: 100,

                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("totalVotes").getContext('2d');
        var totalVotes = new Chart(ctx, {
            type: 'verticalBar',
            data: {
                datasets: [{
                    label: 'totalVotes',
                    data: [<? echo $counterArray[$usrCounter]->popularity;?>],
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
                            suggestedMax: 100,

                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("totalVotes").getContext('2d');
        var totalVotes = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Number of Votes", "Average Votes per Movie"],
                datasets: [{
                    label: '# of Votes',
                    data: [<? echo $counterArray[$usrCounter]->vote_count;?> , 1784.5],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)'
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
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,

                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>
<?php
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

    $apikey = "1025f3429a7803a6570aa7e8ebee1ae8";
    $imgurl_1 = "https://image.tmdb.org/t/p/w500";
    $imgurl_2 = "https://image.tmdb.org/t/p/w300";
  
    $id_movie = $_GET['id'];
    $cm = curl_init();
    curl_setopt($cm, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$id_movie."?api_key=" . $apikey);
    curl_setopt($cm, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($cm, CURLOPT_HEADER, FALSE);
    curl_setopt($cm, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response7 = curl_exec($cm);
    curl_close($cm);
    $movie_id = json_decode($response7);

    $cv = curl_init();
    curl_setopt($cv, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$id_movie."/videos?api_key=" . $apikey);
    curl_setopt($cv, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($cv, CURLOPT_HEADER, FALSE);
    curl_setopt($cv, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response8 = curl_exec($cv);
    curl_close($cv);
    $movie_video_id = json_decode($response8);

    $cs = curl_init();
    curl_setopt($cs, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$id_movie."/similar?api_key=" . $apikey);
    curl_setopt($cs, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($cs, CURLOPT_HEADER, FALSE);
    curl_setopt($cs, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response9 = curl_exec($cs);
    curl_close($cs);
    $movie_similar_id = json_decode($response9);
  
    if(isset($_GET['id'])){
        $id_movie = $_GET['id']; 
        
        
$db = mysqli_connect("10.169.0.177","whatmovi_mattr","Password1","whatmovi_project");
        
if(array_key_exists('submit',$_POST)){
    $sql = $db->query("SELECT * FROM `movieData` WHERE id = '".$id_movie."';");
    if($sql->num_rows < 1){
        $sql = $db->query("INSERT INTO movieData (movieID, movieName, release_date, genre_id, popularity_rating, vote_average, vote_count)
        VALUES ('".$id_movie."','".$movie_id->title."','".$movie_id->release_date."','','".$movie_id->popularity."','".$movie_id->vote_average."','".$movie_id->vote_count."');");
    } else {
        
    }
    
    
    $sql = $db->query("SELECT * FROM `userInfo` WHERE id = '".$_SESSION['id']."' AND movieID = '".$id_movie."';");
    $data = $sql->fetch_array();
    if(!$data){
        $sql = $db->query("INSERT INTO userInfo (id, movieID, movieRating)
VALUES ('".$_SESSION['id']."', '".$id_movie."', '".$_POST['slider']."');");
        echo $_SESSION['id']." ";
        echo $id_movie." ";
        echo $_POST['slider']." ";
        echo "ADDING TO DATABSE";
    } else {
        $sql = $db->query("UPDATE userInfo
SET movieRating = ".$_POST['slider']."
WHERE movieID = ".$id_movie." AND id=".$_SESSION['id'].";");
        echo "UPDATING DATABASE";
    }
}
?>

<html>

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
                    <li class="nav-item">
                        <a class="nav-link" href="ranks.php">Ranks<span class="sr-only"></span></a>
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
    
    <div class="model">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="splitter-s"></div>
                    <?php
                    echo '<h1 id="title">'.$movie_id->title.'</h1>';
                    echo '<h4 id="bio">'.$movie_id->release_date.'</h4>';
                    echo '<p>'.$movie_id->overview.'</p>';
                    ?>
                    <div class="slidecontainer">
                        <form method="POST">
                            <p>Input a value in which you think is appropriate to the movie. <b>Keep it consistent!</b></p>
                            <input name="slider" type="range" min="1" max="100" value="50" class="slider" id="myRange">
                            <p>Value: <span style="color:#FFD700;" id="value"></span></p>
                            <button type="submit" name="submit" class="btn btn-outline-dark">Submit</button>
                        </form>
                    </div>
                </div>
                <?
                echo '<img src="https://image.tmdb.org/t/p/w300'.$movie_id->poster_path.'">';
                ?>
            </div>
        </div>
    </div>
    
    <div class="container">
        <hr>
        <div class="row">
                <?php         
                    $key = $movie_video_id->results;
                    if (isset($key[0])) {                        
                        echo '<iframe width="1920" height="540" src="https://www.youtube.com/embed/'.$key[0]->key.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope" allowfullscreen></iframe>';
                        
                    } else {
                    }
                ?>
        </div>
        <hr>
        <div class="model" style="padding: 1%">
            <h1>
                <?php echo $movie_id->title ?>
            </h1>
            <p>
                <?php echo $movie_id->tagline ?>
            </p>
            <p>Genres :
                <?php
                foreach($movie_id->genres as $g){
                  echo '<span>' . $g->name . '</span> ';
                }
              ?>
            </p>
            <p>Overview :
                <?php echo $movie_id->overview ?>
            </p>
            <p>Release Date :
                <?php $rel = date('d F Y', strtotime($movie_id->release_date)); echo $rel ?>
                <p>Production Companies :
                    <?php
                foreach($movie_id->production_companies as $pc){
                  echo $pc->name." ";
                }
              ?>
                </p>
                <p>Production Countries:
                    <?php
                foreach($movie_id->production_countries as $pco){
                  echo $pco->name. "&nbsp;&nbsp;" ;
                }
              ?>
                </p>
                <p>Vote Average :
                    <?php echo $movie_id->vote_average ?>
                </p>
                <p>Vote Count :
                    <?php echo $movie_id->vote_count ?>
                </p>
        </div>
        <hr>
        <h3>Users that looked at <b>
                <? echo $movie_id->title; ?></b> searched for...</h3>
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
    </div>
    <?php 
    } else{
      echo "<h5>Movie cannot be found, please contant admin if you believe this to be an error.</h5>";
    }
?>
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
</body>

</html>
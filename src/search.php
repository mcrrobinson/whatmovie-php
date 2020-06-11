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

$input=$_GET['search'];
$channel=strtolower($_GET['channel']);
$page=$_GET['page'];
$search = preg_replace('/\s+/', '%20', $input);



$apikey = "1025f3429a7803a6570aa7e8ebee1ae8";

$cs = curl_init();
curl_setopt($cs, CURLOPT_URL, "http://api.themoviedb.org/3/search/".$channel."?api_key=".$apikey."&query=".$search."&page=".$page);
curl_setopt($cs, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($cs, CURLOPT_HEADER, FALSE);
curl_setopt($cs, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response17 = curl_exec($cs);
curl_close($cs);
$search = json_decode($response17);
?>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Copse" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <script src="js/design/prefixfree.min.js"></script>
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
                        <a class="nav-link" href="ranks.php">Ranks</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="browse.php">Browse Movies<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <div class="btn-group">
                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account <i class="fa fa-user"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="options.php" class="dropdown-item" style="color:black;">Options</a>
                            <button class="dropdown-item" type="button">Log Out</button>
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
            <h1>Your Result: "<b><? echo $input; ?></b>" returned results</h1>
        </div>
        <hr>
        <div class="row">
            <?php
            if($channel=="movie"){
                        $rowCounter = 0;
                        foreach($search->results as $results) {
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
                    
                    }elseif($channel=="Tv"){
                        foreach($search->results as $results){
                            $rowCounter = 0;
                            $title 		= $results->name;
                            $id 		= $results->id;
                            $release	= $results->first_air_date;
                            echo '<div class="column">';
                                $backdrop 	= $results->poster_path;
                                if (empty($backdrop) && is_null($backdrop)){
				                    $backdrop =  '/images/no-gambar.jpg';
                                } else {
				                    $backdrop = 'https://image.tmdb.org/t/p/w300'.$backdrop;
                                }
                                echo '<a href="movie.php?id=' . $id . '"><div class="imageFramed" style="background-image:url('.$backdrop.');">';
                                echo '<h4 class="centered">'.$title.'</h4></div></a>';
                            echo '</div>';
		              }
                }
        ?>
        </div>


    </div>
    <hr>
    <nav data-pagination>
        <?php
                    if ($page > 1){
                        $previousPage = $page - 1;
				        echo '<a href='."https://www.whatmovie.tk/search.php?search=".$input."&channel=movie&page=".$previousPage."><<</a>";
                    } else {
				        echo '<a disabled href="#" ><<</a>';
                    }
                    ?>
        <ul>
            <?php 
						for ($x = 1; $x <= $search->total_pages; $x++) {
							?>
            <li><a href=<?php echo("https://www.whatmovie.tk/search.php?search=".$input."&channel=movie&page=".$x) ?>>
                    <?php echo $x ?></a></li>
            <?
						} 
						?>
        </ul>
        <!-- Finish Max Pagination -->
        <?php
                        if ($page == 0){
                            $nextPage = 2;
				            echo '<a href='."https://www.whatmovie.tk/search.php?search=".$input."&channel=movie&page=".$nextPage.">>></a>";
                        } else {
				            $nextPage = $page + 1;
                            echo '<a href='."https://www.whatmovie.tk/search.php?search=".$input."&channel=movie&page=".$nextPage.">>></a>";
                        }
                    ?>
    </nav>
    <div class="splitter-s"></div>
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

    <!-- Messages -->
    <script src="js/header/popupmsgDefault.js"></script>

    <script src='js/dependencies/jquery-3.3.1.min.js'></script>
    <script src='js/header/particles.min.js'></script>
    <script src="js/header/particlescfg.js"></script>

    <script src='js/design/jquery.min.js'></script>
    <script src="js/design/slider.js"></script>

</body>

</html>
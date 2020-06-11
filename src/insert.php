<?php
include 'dbc.php';

$apikey = "1025f3429a7803a6570aa7e8ebee1ae8";
$data = $connection->query("SELECT * FROM `users` WHERE ID = '64';")->fetch_array();
$usrCounter = $data["usrCounter"];
$cPage = $data["cPage"];

if($usrCounter == 19){
    $usrCounter = 0;
    $cPage = $cPage + 1;
    $sql = $connection->query("UPDATE users SET usrCounter='0', cPage='$cPage' WHERE id='64'");
} else {
    $usrCounter = $usrCounter + 1;
    $sql = $connection->query("UPDATE users SET usrCounter='$usrCounter' WHERE id='64'");
}

$rated = curl_init();
curl_setopt($rated, CURLOPT_URL, "https://api.themoviedb.org/3/discover/movie?api_key=".$apikey."&language=en-US&sort_by=vote_count.desc&include_adult=false&include_video=false&page=".$cPage."&with_original_language=en");
curl_setopt($rated, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($rated, CURLOPT_HEADER, FALSE);
curl_setopt($rated, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$ratedMovies = json_decode(curl_exec($rated));
curl_close($rated);
$topRatedResults = $ratedMovies->results;

$movieRating = $_POST['name'];
$apikey = "1025f3429a7803a6570aa7e8ebee1ae8";
function sigmoid($x){ return 1 / (1 + exp(-0.055 * ($x -50))); }

if (is_numeric($movieRating)){
    $sql = $connection->query("SELECT * FROM `moviedata` WHERE movieID = '".$topRatedResults[$usrCounter]->id."';");
    if($sql->num_rows < 1){ $sql = $connection->query("INSERT INTO movieData (movieID, movieName, release_date)
    VALUES ('".$topRatedResults[$usrCounter]->id."','".$topRatedResults[$usrCounter]->title."','".$topRatedResults[$usrCounter]->release_date."');");}
    
    $data = $connection->query("SELECT * FROM `userInfo` WHERE ID = '64' AND movieID = '".$topRatedResults[$usrCounter]->id."';")->fetch_array();
    if(!$data){ $sql = $connection->query("INSERT INTO userinfo (id, movieID, movieRating) VALUES ('64', '".$topRatedResults[$usrCounter]->id."', '".$_POST['name']."');");
    } else { $sql = $connection->query("UPDATE userinfo SET movieRating = ".$_POST['name']." WHERE movieID = ".$topRatedResults[$usrCounter]->id." AND ID = '64';");}
    
    $result = mysqli_query($connection,"SELECT * FROM users WHERE id='64'")->fetch_assoc(); //Retrieves data on genres
    foreach($topRatedResults[$usrCounter]->genre_ids as $value){ //Loops array in movie genre API
        if(array_key_exists($value, $result)){ //If movie genre matches with database
            $aKey = $result["$value"]*10;
            $aMean = (($movieRating/10)+$aKey)/2;
            mysqli_query($connection,"UPDATE users SET `".$value."`='".round(sigmoid($aMean),4)."' WHERE ID=64;");
        }
    }
    $result = mysqli_query($connection,"SELECT * FROM users WHERE id='64'")->fetch_assoc();
} else { echo "Input a number."; }

echo '
<div id="poster" class="item1">
    <img src="https://image.tmdb.org/t/p/w300'.$topRatedResults[$usrCounter]->poster_path.'"/>
</div>
<div id ="information" class="item2">
    <h1>'.$topRatedResults[$usrCounter]->title.'</h1>
    <p>'.$topRatedResults[$usrCounter]->release_date.'</p>
    <p>'.$topRatedResults[$usrCounter]->overview.'</p>
</div>'
?> 
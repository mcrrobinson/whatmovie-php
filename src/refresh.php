<?php
include 'dbc.php';
$apikey = "1025f3429a7803a6570aa7e8ebee1ae8";
$sql = $connection->query("SELECT * FROM `users` WHERE ID = '64';")->fetch_array();

////Variables Static and Dynamic
//$vote_count = 3357;
//$vote_average = 9.2;
//$imdb_average = 6.38;
//$popularity = 409.492;
//$yearofrelease = 2001;
//$wr = (($vote_count / ($vote_count + 50)) * $vote_average + (50 / ($vote_count + 50)) * $imdb_average);
//echo "--------------------<br>";
//echo "<br>Movie Ranking from individuals: " . $wr . "<br>";

$mean = $sql['28'] + $sql['12'] + $sql['16'] + $sql['35'] + $sql['80'] + $sql['99'] + $sql['18'] + $sql['10751'] + $sql['14'] + $sql['36'] + $sql['27'] + $sql['10402'] + $sql['9648'] + $sql['10749'] + $sql['878'] + $sql['10770'] + $sql['53'] + $sql['10752'] + $sql['37']/10;
$perc = 100;

$randomArray = array('$sql["28"]' , '$sql["12"]' , '$sql["16"]' , '$sql["35"]' , '$sql["80"]' , '$sql["99"]' , '$sql["18"]' , '$sql["10751"]' , '$sql["14"]' , '$sql["36"]' , '$sql["27"]' , '$sql["10402"]' , '$sql["9648"]' , '$sql["10749"]' , '$sql["878"]' , '$sql["10770"]' , '$sql["53"]' , '$sql["10752"]' , '$sql["37"]');


echo "Action: ".$action = ($sql['28']/$mean)*$perc."%<br>";
echo "Adventure: ".$adventure = ($sql['12']/$mean)*$perc."%<br>";
echo "Animation: ".$animation = ($sql['16']/$mean)*$perc."%<br>";
echo "Comedy: ".$comedy = ($sql['35']/$mean)*$perc."%<br>";
echo "Crime: ".$crime = ($sql['80']/$mean)*$perc."%<br>";
echo "Documentary: ".$documentary = ($sql['99']/$mean)*$perc."%<br>";
echo "Drama: ".$drama = ($sql['18']/$mean)*$perc."%<br>";
echo "Family: ".$family = ($sql['10751']/$mean)*$perc."%<br>";
echo "Fantasy: ".$fantasy = ($sql['14']/$mean)*$perc."%<br>";
echo "History: ".$history = ($sql['36']/$mean)*$perc."%<br>";
echo "Horror: ".$horror = ($sql['27']/$mean)*$perc."%<br>";
echo "Musical: ".$musical = ($sql['10402']/$mean)*$perc."%<br>";
echo "Mystery: ".$mystery = ($sql['9648']/$mean)*$perc."%<br>";
echo "Romance: ".$romance = ($sql['10749']/$mean)*$perc."%<br>";
echo "Science Fiction: ".$scifi = ($sql['878']/$mean)*$perc."%<br>";
echo "TV Movie: ".$tvmov = ($sql['10770']/$mean)*$perc."%<br>";
echo "Thriller: ".$thriller = ($sql['53']/$mean)*$perc."%<br>";
echo "War: ".$war = ($sql['10752']/$mean)*$perc."%<br>";
echo "Western: ".$western = ($sql['37']/$mean)*$perc."%<br>";

$randIndex = array_rand($randomArray);
$var1 = eval('return '. $randomArray[$randIndex] . ';');
$randIndex = array_rand($randomArray);
$var2 = eval('return '. $randomArray[$randIndex] . ';');

if($var1 > $var2){
    echo $var1;
} else {
    echo $var2;
}
?>
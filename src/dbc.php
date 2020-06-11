<?php
$host = "10.169.0.177";
$user = "whatmovi_mattr";
$password = "Password1";
$dbase = "whatmovi_project";
$table = "userInfo"; 
$connection= mysqli_connect ($host, $user, $password, $dbase);
if (!$connection)
{
die ('Could not connect:' . mysqli_error());
}
?>
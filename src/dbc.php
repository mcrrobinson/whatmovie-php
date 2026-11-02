<?php
$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$password = getenv("DB_PASS");
$dbase = getenv("DB_NAME");
$table = "userInfo"; 
$connection= mysqli_connect ($host, $user, $password, $dbase);
if (!$connection)
{
die ('Could not connect:' . mysqli_error());
}
?>
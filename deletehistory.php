<?php 

$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query="DELETE from logs";
$exec=pg_query($query);
header('location: dashboard.php');

?>
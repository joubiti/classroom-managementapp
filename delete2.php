<?php
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$id_prof=$_GET['id_prof'];
$type='supprimé';
$status='professeur';
if(!$id_prof){
	header('location: prof.php');
}
$query="DELETE from prof where id_prof=$id_prof";
$result=pg_query($query);
$query2="INSERT INTO logs(type,status) VALUES('$type','$status')";
$logz=pg_query($query2);
header('location: prof.php')
?>

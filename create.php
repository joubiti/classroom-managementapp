<?php
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$search=$_POST['create'];
$type='créé';
$status='étudiant';
if(!$search){
	header('Location: studentpanel2.php');
	exit;
}
$query="INSERT into students(PRENOM) values('$search')";
$result=pg_query($query);
$query2="INSERT INTO logs(type,status) VALUES('$type','$status')";
$result2=pg_query($query2);
header('Location: studentpanel2.php');
?>
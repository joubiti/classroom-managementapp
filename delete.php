<?php
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$id=$_POST['id'];
$type='supprimé';
$status='étudiant';
if(!$id){
	header('Location: studentpanel2.php');
	exit;
}
$query="DELETE from students where id=$id";
$result=pg_query($query);
$query2="INSERT INTO logs(type,status) VALUES('$type','$status')";
$logz=pg_query($query2);
header('Location: studentpanel2.php');
?>
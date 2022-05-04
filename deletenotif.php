<?php
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$id=$_POST['id'];
if(!$id){
	header('Location: studentpanel.php');
	exit;
}
$query="DELETE from notif where id=$id";
$result=pg_query($query);
header('Location: studentpanel.php');
?>
<?php
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$id=$_POST['select'];
// var_dump($id);
// die();
$email=$_POST['email'];
var_dump($email);
// die();
$notifi="INSERT into notif(email,id) VALUES('$email',$id)";
$executionnotif=pg_query($notifi);
// var_dump($executionnotif);
// die();
header('location: studentpanel.php')
?>
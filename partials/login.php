<?php 


$errors=[];
if ($_SERVER['REQUEST_METHOD']==="POST"){
  $username=$_POST['username'];
  $password=$_POST['password'];
if (!$username){
  $errors[]="Please write a valid username";
}
if (!$password){
  $errors[]="Please write a valid password";
}
if(!$errors){
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$queryusername="SELECT status from users where username='$username'";
$ji=pg_query($queryusername);
$ji1=pg_fetch_row($ji);
$status=$ji1[0];
if($username==='admin' && $password==='admin'){
	session_start();
	$_SESSION['username']=$username;
	$_SESSION['status']=$status;
  header('location: dashboard.php');
}
else{
$query="SELECT * from users where username='$username' and password='$password'";
$result=pg_query($query);
$x=pg_fetch_array($result);
$count=pg_num_rows($result);
if($count==1){
	session_start();
	$_SESSION['username']=$username;
	$_SESSION['status']=$status;
	$status=trim($status);
	if($status=="professeur"){
	echo "echo test";
	$querytest="SELECT id_prof from profprenom where username='$username'";
	$qs=pg_query($querytest);
	$qs1=pg_fetch_row($qs);
	$id=$qs1[0];
	$_SESSION['id']=$id;
	$querytest2="SELECT * from module where id_prof=$id";
	$querypg=pg_query($querytest2);
	var_dump(pg_num_rows($querypg));
	if(pg_num_rows($querypg)==0){
		header('location: modulechoice.php');
	}
	else{
		header('location: panelprof.php');
	}
	}
	else{
	$querytest="SELECT id from studentprenom where username='$username'";
	$qs=pg_query($querytest);
	$qs1=pg_fetch_row($qs);
	$id=$qs1[0];
	$_SESSION['id']=$id;
  header('location: paneletudiant.php');
  }
}
else{
  $errors[]="Nom d'utilisateur/mot de passe invalide.";
}
}
}
}
?>
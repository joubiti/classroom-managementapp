<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$id=$_POST['id'];
$module=$_POST['module'];
$note=$_POST['note'];
$depot1="SELECT id_module from module where nom_module='$module'";
$qm1=pg_query($depot1);
$qrow=pg_fetch_row($qm1);
$id_module=$qrow[0];
$test="SELECT * from note_module where id_module=$id_module and id=$id";
$testquery=pg_query($test);
$testnumbers=pg_num_rows($testquery);
$testemail="SELECT * from notif where id=$id";
$testquery=pg_query($testemail);
$testassoc=pg_fetch_assoc($testquery);
$email=$testassoc['email'];
$msg= "Un module est affiché sur le site: " . $module ."";
$mail = new PHPMailer(true);
$count=pg_num_rows($testquery);

if ($testnumbers!=0){
	$depot2="UPDATE note_module SET note_module=$note where id_module=$id_module and id=$id";
	$qm2=pg_query($depot2);
	if($count!=0){
		include_once('partials/emailsender.php');
	}
	header('location: fiche.php?id='.$id);
}
else{
$depot2="INSERT INTO note_module(id_module,id,note_module) VALUES($id_module,$id,$note)";
$qm2=pg_query($depot2);
if($count!=0){
		include_once('partials/emailsender.php');
	}
header("location: fiche.php?id=".$id);
}
?>
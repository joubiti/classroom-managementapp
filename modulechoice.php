<?php 
include_once('partials/pythonarray.php');
session_start();
$id_prof=$_SESSION['id'];
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query="SELECT prenom_prof from prof where id_prof=$id_prof";
$queryr=pg_query($query);
$row=pg_fetch_row($queryr);
$prenom_prof=$row[0];
if ($_SERVER['REQUEST_METHOD']==="POST"){
foreach($_POST['select'] as $module){
$query3="INSERT into module(nom_module,id_prof) values('$module','$id_prof')";
$result2=pg_query($query3);
header('Location: panelprof.php');
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Choix de module</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" action="modulechoice.php" method="POST" enctype="multipart/form-data">
					<span class="login100-form-title p-b-70">
						<?php $message="Bienvenue, ". $prenom_prof."!";
						echo $message; ?>
					</span>
					<label style="color: black; font-weight: bold">Module(s) pris en charge</label>
<br>
<select name="select[]" style="width: 390px" size="15" class="form-select form-select-sm p-2" multiple aria-label=".form-select-sm example">
  <?php foreach($array as $module): ?>
  <option value='<?php echo $module ?>' <?php 
  $dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
  $check="SELECT * from module where nom_module='$module'";
  $checkr=pg_query($check);
  $arraycheck=pg_fetch_array($checkr);
  $count=pg_num_rows($checkr); 
  if ($count==1):?> disabled <?php endif; ?>><?php echo $module ?></option>
<?php endforeach ?>
</select>
<br>

					<div class="container-login100-form-btn pt-3">
						<button class="login100-form-btn " type="submit">
							Valider
						</button>
					</div>



				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
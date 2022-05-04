<?php
$errors=[];
if ($_SERVER['REQUEST_METHOD']==="POST"){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $status=$_POST['status'];
  $prenom=$_POST['prenom'];
if (!$username){
  $errors[]="Please write a valid username";
}
if (!$password){
  $errors[]="Please write a valid password";
}
if(!$errors){
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query="INSERT into users VALUES('$username','$password','$status')";
$result=pg_query($query);
if($status=='etudiant'){
  $query1="INSERT into students(PRENOM) VALUES('$prenom')";
  $result1=pg_query($query1);
  $selectid="SELECT id from students where prenom='$prenom'";
  $selectr=pg_query($selectid);
  $selectrow=pg_fetch_row($selectr);
  $id=$selectrow[0];
  $queryusers="INSERT INTO studentprenom(username,id) VALUES('$username','$id')";
  $queryr1=pg_query($queryusers);
}
if($status=='professeur'){
  $query2="INSERT into prof(prenom_prof) VALUES('$prenom')";
  $result2=pg_query($query2);
  $selectid="SELECT id_prof from prof where prenom_prof='$prenom'";
  $selectr=pg_query($selectid);
  $selectrow=pg_fetch_row($selectr);
  $id=$selectrow[0];
  $queryusers="INSERT INTO profprenom(username,id_prof) VALUES('$username','$id')";
  $queryr1=pg_query($queryusers);
}
header('location: index.php');
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Inscription</title>
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
				<form class="login100-form validate-form" action="signup.php" method="POST" enctype="multipart/form-data">
					<span class="login100-form-title p-b-70">
						Page d'inscription
					</span>
					<span class="login100-form-avatar">
						<img src="images/avatar-01.jpg" alt="AVATAR">
					</span>
					<?php foreach ($errors as $error): ?>
<br>
<div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
  <div>
  	<i class="fa fa-warning fa-sm"></i>
    <?php echo $error ?>
  </div>
</div>
<?php endforeach ?>

					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Nom d'utilisateur"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Mot de passe"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50 " data-validate = "Enter your name">
						<input class="input100" type="text" name="prenom">
						<span class="focus-input100" data-placeholder="Nom et prénom"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50 " data-validate = "Enter your name">
						<select class="form-select" style="width: 400px" name="status" aria-label="Default select example" >
  <option name ="professeur" value="professeur">Professeur</option>
  <option name="etudiant" value="etudiant">Etudiant(e)</option>
</select>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							S'inscrire
						</button>
					</div>

					<ul class="login-more p-t-190">
						<!-- <li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

							<a href="#" class="txt2">
								Username / Password?
							</a>
						</li> -->

						<li>
							<span class="txt1">
								Vous avez déjà un compte?
							</span>

							<a href="login.php" class="txt2">
								Connectez-vous
							</a>
						</li>
					</ul>
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
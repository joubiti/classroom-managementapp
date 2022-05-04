<?php
session_start();
include_once 'partials/pythonarray.php';
$type='créé';
$status='professeur';
$errors=[];
if ($_SERVER['REQUEST_METHOD']==="POST"){
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
foreach($_POST['select'] as $module){
  $check="SELECT * from module where nom_module='$module'";
  $checkr=pg_query($check);
  $arraycheck=pg_fetch_array($checkr);
  $count=pg_num_rows($checkr);
  if ($count==1){
    $errors[]='Module(s) déjà pris en charge par un autre professeur!';
  }
  }

if(!$errors){
$title=$_POST['title'];
$query1="INSERT into prof(prenom_prof) values('$title')";
$result=pg_query($query1);
$querylogz="INSERT INTO logs(type,status) VALUES('$type','$status')";
$logz=pg_query($querylogz);
$query2="SELECT id_prof from prof where prenom_prof='$title'";
$result1=pg_query($query2);
$row=pg_fetch_row($result1);
$id_prof=$row[0];
foreach($_POST['select'] as $module){
$query3="INSERT into module(nom_module,id_prof) values('$module','$id_prof')";
$result2=pg_query($query3);
header('Location: prof.php');
}
}
}





?>

<?php include_once 'partials/navbaradmin.php'?>
    <!-- Page Content -->
    <div id="page-wrapper">
      <br>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<?php foreach ($errors as $error): ?>
  <label>
<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <?php echo $error ?>
                                    </div>
                                  </label>
<?php endforeach ?>
<br>
<div class="col-lg-4">
                            <div style="width: 700px" class="panel panel-primary">
                                <div class="panel-heading">
                                    Plateforme création
                                </div>
                                <div class="panel-body">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle fa-fw"></i>Un professeur peut enseigner plusieurs modules.
                                    </div>
                                    <label>Nom du professeur</label>
                                    <form style="width: 700px" action="createprof.php" method="POST" enctype="multipart/form-data">
    <div id="test" class="input-group mb-3">
  <input type="text"  class="form-control" placeholder="" aria-label="title" name ="title" aria-describedby="basic-addon1">
</div>
<br>
<label style="color: black;">Module(s) pris en charge</label>
<br>
<select name="select[]" style="width: 600px" size="15" class="form-select form-select-sm" multiple aria-label=".form-select-sm example">
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
<div class="input-group mb-3">
<button type="submit" class="btn btn btn-primary" style="width: 600px">Créer</button>
<br>
<br>
<br>
</form>
                                    
                                </div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>

</body>
</html>
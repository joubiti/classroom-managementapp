<?php 
session_start();
  $dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query="SELECT * from students";
$result=pg_query($query);

$query2="SELECT * from notif";
$result2=pg_query($query2);

// $assoc=pg_fetch_assoc($result);
?>


<?php include_once 'partials/navbaradmin.php'?>
    <div id="page-wrapper">
        <br>
  <div class="mb-3">
    <br>
    <div class="col-lg-4">
                            <div style="width: 700px" class="panel panel-primary">
                                <div class="panel-heading">
                                    Plateforme de système de notifications
                                </div>
                                <div class="panel-body">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle fa-fw"></i>L'étudiant sera notifié des changements concernant les modules & emplois du temps via email.
                                    </div>
                                    <label>Adresse email</label>
                                    <form style="width: 700px" action="notif.php" method="POST" enctype="multipart/form-data">
    <div id="test" class="input-group mb-3">
  <input type="email" name="email" style="width: 500px" class="form-control" placeholder="" id="exampleInputEmail1" aria-describedby="emailHelp">
</div>
<br>
<label style="color: black;">Etudiant associé à cette adresse email</label>
<br>
<select name="select" size="7" style="width: 600px;"class="form-select form-select-sm" multiple aria-label=".form-select-sm example">
  <?php while($assoc=pg_fetch_assoc($result)): ?>
  <option value="<?php echo $assoc['id'] ?>" <?php 
  $dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
  $idcheck=$assoc['id'];
  $check="SELECT * from notif where id=$idcheck";
  $checkr=pg_query($check);
  $arraycheck=pg_fetch_array($checkr);
  $count=pg_num_rows($checkr); 
  if ($count==1):?> disabled <?php endif; ?>
    ><?php echo $assoc['prenom'] ?></option>
<?php endwhile ?>
</select>
<br>
<div class="input-group mb-3">
<button type="submit" class="btn btn btn-primary" style="width: 600px">S'abonner</button>
<br>
<br>
<br>
</form>
                                    
                                </div>
                                <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Prenom</th>
                                                    <th>Email</th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php while($assocnotif=pg_fetch_assoc($result2)):?>
                                                <tr class="warning">
                                                    <td><?php $notifid=$assocnotif['id'];
                                                    echo $assocnotif['id'] ?></td>
                                                    <td><?php $searchstudent="SELECT prenom from students where id=$notifid";
                                                    $querysearch=pg_query($searchstudent);
                                                    $variable3=pg_fetch_row($querysearch);
                                                    echo $variable3[0] ?></td>
                                                    <td><?php echo $assocnotif['email'] ?></td>
                                                    <td><form style="display:  inline-block" method="POST" action="deletenotif.php">
            <input type="hidden" name="id" value="<?php echo $assocnotif['id'] ?>">
            <button type="submit" type="button" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td>
      </form></td>
                                                </tr>
                                              <?php endwhile ?>
                                            </tbody>
                                        </table>
                                    </div>
            </div>

<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>
</body>
</html>
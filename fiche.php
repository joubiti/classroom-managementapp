<?php

session_start();
include_once 'partials/pythonarray.php';
$id=$_GET['id'];
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");


?>
<?php include_once 'partials/navbaradmin.php'?>

    <!-- Page Content -->
    <div id="page-wrapper">
        <br>
        <div class="panel-body">
            <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <thead>
    <tr>
      <th scope="col">Nom du module</th>
      <th scope="col">Note finale</th>
      <th scope="col">Encadrant</th>
      <th scope="col">Actions</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($array as $module): ?>
    <tr class="odd gradeX">
      <th scope="row"><?php echo $module ?></th>
      <td><?php
      $rech1="SELECT id_module from module where nom_module='$module'";
      $exec=pg_query($rech1);
      if($execr=pg_fetch_row($exec)){
      $id_module=$execr[0];
      $rech2="SELECT note_module from note_module where id_module=$id_module and id=$id";
      $exec2=pg_query($rech2);
      $execr2=pg_fetch_row($exec2);
      echo $execr2[0] ?? '';
      }
      else{
        echo '';
      }
    ?> </td>
      <td>
        <?php $prof="SELECT id_prof from module where nom_module='$module'";
       $q=pg_query($prof);
       if ($qrow=pg_fetch_row($q)){
       $id_prof=$qrow[0];
       $nameprof="SELECT prenom_prof from prof where id_prof=$id_prof";
       $nameprofq=pg_query($nameprof);
       $nameprofrow=pg_fetch_row($nameprofq);
       echo $nameprofrow[0];
       }
       else{
        echo'';
        }
        ?>
      </td>
      <td>
        <a  href="grading.php?id=<?php echo $id?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Modifier la note</a>
    </td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>

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
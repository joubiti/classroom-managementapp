<?php

session_start();
$id=$_SESSION['id'];
include_once('partials/pythonarray.php');
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query4="SELECT * from notif where id=$id";
$result4=pg_query($query4);
$number=pg_num_rows($result4);


?>
<?php include_once('partials/navbarstudent.php'); ?>
<div id="page-wrapper">
    <br>
    <div class="panel panel-default">
        <?php if ($number==0):?>
                                <div class="panel-heading">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle fa-fw"></i>Pour recevoir des notifications par e-mail
                                    </div>
                                <form style="width: 700px" action="notif2.php" method="POST" enctype="multipart/form-data">
    <div id="test" class="input-group mb-3">
  <input type="email" name="email" style="width: 500px" class="form-control" placeholder="Adresse email" id="exampleInputEmail1" aria-describedby="emailHelp">
  <button type="submit">S'abonner</button>
                                </div>
                            <?php endif ?>
        <div class="panel-body">
            <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <thead>
    <tr>
      <th scope="col">Nom du module</th>
      <th scope="col">Note finale</th>
      <th scope="col">Encadrant</th>

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
    </tr>
  <?php endforeach ?>
  </tbody>
</table>
</div>

         </div>
     </div>

 </body>
</html>
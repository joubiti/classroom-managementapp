<?php
session_start();
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query="SELECT * from prof";
$result=pg_query($query);
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
                                                    <th>ID</th>
                                                    <th>Prenom</th>
                                                    <th>Module(s) pris en charge</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($assoc=pg_fetch_assoc($result)): ?>
                                                <tr class="odd gradeX">
                                                    <th scope="row"><?php echo $assoc['id_prof']?></th>
      <td><?php echo $assoc['prenom_prof'] ?></td>
      <td><?php $id_prof= $assoc['id_prof'];
      $query1="SELECT nom_module  from module WHERE id_prof='$id_prof'";
      $result1=pg_query($query1);
      while($row=pg_fetch_array($result1)){
        echo $row[0].',';
      }
      
?></td>
      <td>
        <!-- <a  href="update.php?id=<?php echo $assoc['id_prof'];?>"><span style="color: dodgerblue">
        <i class="fas fa-user-edit fa-lg"></i>
      </span></a> -->
         <form style="display:  inline-block" method="GET" action="delete2.php">
          <input type="hidden" name="id_prof" value="<?php echo $assoc['id_prof'] ?>" >
          <button type="submit" type="button" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i>
      </button></td>
      </form> 
    </td>
</tr>
                                                <?php endwhile ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
<?php

session_start();
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query="SELECT * from students";
$result=pg_query($query);
$rows=pg_num_rows($result);


?>
<?php include_once 'partials/navbaradmin.php'?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <br>
        <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <form method="POST" action="create.php">
                                <div class="form-group input-group">
                                                    <input type="text" name="create" placeholder="Créer un étudiant.." class="form-control">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="submit"><i class="fa fa-plus"></i>
                                                        </button>
                                                    </span>
                                </div>
                            </form>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Prenom</th>
                                                    <th>Notes académiques</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($assoc=pg_fetch_assoc($result)): ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $assoc['id']?></td>
                                                    <td><?php echo $assoc['prenom'] ?></td>
                                                    <td><a href="fiche.php?id=<?php echo $assoc['id']?>">Voir la fiche des notes</a></td>
                                                    <td class="center"><a  href="grading.php?id=<?php echo $assoc['id']?>" class="btn btn-primary btn-sm">Déposer des notes</a>
        <form style="display:  inline-block" method="POST" action="delete.php">
          <input type="hidden" name="id" value="<?php echo $assoc['id'] ?>">
          <button type="submit" type="button" class="btn btn-danger btn-sm">Supprimer</button></td>
      </form></td>
                                                
                                                </tr>
                                                <?php endwhile ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
</body>
</html>
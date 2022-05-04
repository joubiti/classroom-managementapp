<?php 

session_start();
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query="SELECT * from students";
$result=pg_query($query);
$numberstudents=pg_num_rows($result);
$id=$_SESSION['id'];
$query2="SELECT prenom from students where id=$id";
$queryf=pg_query($query2);
// $queryf1=pg_fetch_row($queryf);
// $prenom=$queryf1[0];
$i=0;
$query3="SELECT * from module where id_prof=$id";
$query3f=pg_query($query3);

?>
<?php include_once('partials/navbarprof.php')?>
        <div id="page-wrapper">
<br>
 <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nom de l'étudiant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($assoc=pg_fetch_assoc($result)): ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $i+1;
                                                    $i++;
                                                    ?></td>
                                                    <?php $name=$assoc['prenom']; ?>
                                                    <td><?php $name=$assoc['prenom'];
                                                    echo $name; ?></td>
                                                
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
     </div>
 </body>
</html>

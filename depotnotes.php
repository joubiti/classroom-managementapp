<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


error_reporting(E_ERROR | E_PARSE);
session_start();
$id_module=$_GET['id'];
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$query="SELECT * from students";
$result=pg_query($query);
$id_prof=$_SESSION['id'];
$i=0;
$query3="SELECT * from module where id_prof=$id_prof";
$query3f=pg_query($query3);
$qq="SELECT nom_module from module where id_module=$id_module";
$qq12=pg_query($qq);
$qqr=pg_fetch_row($qq12);
$module=$qqr[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$idetudiants=$_POST['idetudiants'];
foreach($_POST['notes'] as $key=>$note_module){
    if($note_module!==''){
        $id=$idetudiants[$key];
        $testemail="SELECT * from notif where id=$id";
        $testquery=pg_query($testemail);
        $testassoc=pg_fetch_assoc($testquery);
        $email=$testassoc['email'];
        $msg= "Un module est affiché sur le site: " . $module ."";
        $mail = new PHPMailer(true);
        $count=pg_num_rows($testquery);
        $test="SELECT * from note_module where id_module=$id_module and id=$id";
        $testquery=pg_query($test);
        $testnumbers=pg_num_rows($testquery);
        if ($testnumbers!=0){
    $depot2="UPDATE note_module SET note_module=$note_module where id_module=$id_module and id=$id";
    $qm2=pg_query($depot2);
    if($count!=0){
        try{
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;  
        $mail->SMTPSecure ='ssl' ;                                //Enable SMTP authentication
        $mail->Username   = 'studentapplicationtest@gmail.com';                     //SMTP username
        $mail->Password   = ')$d\`?3?U,f-YHe2';                               
        $mail->Port       = 465;
        $mail->isHTML();
        $mail->setFrom('studentapplicationtest@gmail.com');
        $mail->Subject='Note de module';
        $mail->Body=$msg;
        $mail->addAddress($email);
        $mail->Send();
        }
        catch (Exception $e){
            header('location: panelprof.php');
        }
    }
    }
        else{
        $sqlnote="INSERT into note_module(id_module,id,note_module) VALUES($id_module,$id,$note_module)";
        $sqlr=pg_query($sqlnote);
        if($count!=0){
        try{
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;  
        $mail->SMTPSecure ='ssl' ;                                //Enable SMTP authentication
        $mail->Username   = 'studentapplicationtest@gmail.com';                     //SMTP username
        $mail->Password   = ')$d\`?3?U,f-YHe2';                               
        $mail->Port       = 465;
        $mail->isHTML();
        $mail->setFrom('studentapplicationtest@gmail.com');
        $mail->Subject='Note de module';
        $mail->Body=$msg;
        $mail->addAddress($email);
        $mail->Send();
        }
        catch (Exception $e){
            header('location: panelprof.php');
        }
    }
        }
    }
}
}







?>
<?php include_once('partials/navbarprof.php')?>
<div id="page-wrapper">
<br>
        <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="font-weight :bold">
                                    <?php $k="SELECT nom_module from module where id_module=$id_module";
                                    // var_dump($id_module);
                                    $kq=pg_query($k);
                                    $kr=pg_fetch_row($kq);
                                    echo $kr[0];?>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nom de l'étudiant</th>
                                                    <th style="width: 30%" >Note du module</th></div>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($assoc=pg_fetch_assoc($result)): ?>
                                                <tr class="odd gradeX pb-5" >
                                                    <td><?php echo $i+1;
                                                    $i++;
                                                    ?></td>
                                                    <?php 
                                                    $name=$assoc['prenom'];
                                                    $id=$assoc['id']; ?>
                                                    <td><?php $name=$assoc['prenom'];
                                                    echo $name; ?></td>
                                                    <td><form method="POST" style="display: inline-block" enctype="multipart/form-data">
        <div class="form-group input-group">
            <input type="hidden" name="idetudiants[]" value="<?php echo $id ?>">
            <input type="text" style="width: 50px" name="notes[]" class="form-control" id="inputPassword2" placeholder="<?php
      $rech2="SELECT note_module from note_module where id_module=$id_module and id=$id";
      $exec2=pg_query($rech2);
      if($execr2=pg_fetch_row($exec2)){
      echo $execr2[0] ?? '';
  }
  else{
    echo '';
}
?>"
                                                
                                                </tr>
                                                <?php endwhile ?>
                                            </tbody>
                                        </table>
                                        <div class="mx-auto text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Valider</button>
                                    </div>
                                </div>
                            </form>
                        



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
<?php 
session_start();
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$id=$_SESSION['id'];
$query3="SELECT * from module where id_prof=$id";
$query3f=pg_query($query3);
include_once('partials/pythonemploi.php');
?>
<?php include_once('partials/navbarprof.php'); ?>
<div id="page-wrapper">
<br>
<iframe src=<?php echo $newlink ?> style="width:1500px; height:1500px;" frameborder="0"></iframe>
</div>
</div>
</body>
</html>
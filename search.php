<?php
session_start();
if ($_SERVER['REQUEST_METHOD']==="POST"){
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
$string=$_POST['search'];

$query="SELECT * from students where prenom like '%{$string}%'";
$result=pg_query($query);
//$assoc=pg_fetch_assoc($result);
//var_dump($assoc);
//die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>StudentSys</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="adminpanel.php">StudentSys</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <!-- <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul> -->

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a  href="logout.php">
                    <i class="fa fa-sign-out fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['username'] ?><b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <form method="POST" action="search.php">
                        <div class="input-group custom-search-form">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher un étudiant">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </form>
                    </li>
                    <li>
                        <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
                    </li>
                    <li>
                        <a href="studentpanel2.php"><i class="fa fa-user fa-fw"></i> Fiche d'étudiants</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-suitcase fa-fw"></i> Espace professeur<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                                    <li>
                                        <a href="prof.php"><i class="fa fa-file-text-o fa-fw"></i> Fiche des professeurs</a>
                                    </li>
                                    <li>
                                        <a href="createprof.php"><i class="fa fa-user-plus fa-fw"></i> Créer un prof</a>
                                    </li>
                                </ul>
                    </li>
                    <li>
                        <a href="notif.php"><i class="fa fa-wrench fa-fw"></i> Student Panel</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

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
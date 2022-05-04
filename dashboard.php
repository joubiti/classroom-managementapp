<?php
session_start();
$dbconn2 = pg_connect("host=localhost port=5433 dbname=stage user=postgres password=admin");
include_once('partials/adminstats.php')
?>
<?php include_once 'partials/navbaradmin.php'?>
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Tableau de bord</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $rows ?></div>
                                            <div>Etudiants</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="studentpanel2.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Voir la liste des élèves</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-suitcase fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $rows3 ?></div>
                                            <div>Professeurs</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="prof.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Voir la liste des professeurs</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $rows2 ?></div>
                                            <div>Comptes utilisateurs actifs</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Voir la liste des comptes actifs</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-rss fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $rows4 ?></div>
                                            <div>Inscrits au système de notif</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="studentpanel.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Voir la liste des abonnés</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-history fa-fw"></i> Dernières actions
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        <?php while($logassoc=pg_fetch_assoc($logr1)): ?>
                                        <a href="#" class="list-group-item">
                                            <?php if($logassoc['status']=="étudiant"):?>
                                                <i class="fa fa-user fa-fw"></i>

                                            <?php else: ?>
                                                    <i class="fa fa-suitcase fa-fw"></i>
                                            <?php endif; ?>
                                            
                                            <?php $message="Vous avez  ". $logassoc['type']. " un ". $logassoc['status']."";
                                            echo $message; ?>
                                                <span class="pull-right text-muted small"><em><?php echo $logassoc['date_trunc'];?></em>
                                                </span>
                                        </a>
                                     <?php endwhile ?>
                                    <a href="deletehistory.php" class="btn btn-danger btn-block"><i class="fa fa-trash fa-lg"></i> Effacer l'historique des actions</a>
                                </div>
<script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="../js/raphael.min.js"></script>
        <script src="../js/morris.min.js"></script>
        <script src="../js/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>

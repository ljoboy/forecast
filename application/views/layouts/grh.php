
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url('assets/production/images/favicon.ico') ?>" type="image/x-icon">

    <title><?php echo (isset($title)) ? ucwords($title) : "Tableau de bord" ?> | <?php echo ucwords(APP_NAME) ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/vendors/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'); ?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets/vendors/jqvmap/dist/jqvmap.min.css"'); ?> rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.min.css'); ?>" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo index_page() ?>" class="site_title"><i class="fa fa-paw"></i> <span><?php echo strtoupper(APP_NAME) ?></span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="<?php echo base_url('assets/production/images/user.png') ?>" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bienvenue,</span>
                        <h2><?php echo ucfirst($this->session->info->prenom)." ".strtoupper($this->session->info->nom) ?></h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <?php if ($this->session->level == ADMIN_LEVEL || $this->session->level == GRH_LEVEL): ?>
                        <!--                            Ressources Humaines -->
                        <div class="menu_section">
                            <h3>Ressources humaines</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-line-chart"></i> Statistiques <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="index.html">Dashboard</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-user-md"></i> Agents <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('agent/index') ?>">Liste des agents</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-building"></i> Départements <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('departement/index') ?>">Lister</a></li>
                                        <li><a href="<?php echo site_url('departement/create') ?>">Ajouter</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-building"></i> Taches <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('tache/index') ?>">Liste des tâches</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-building"></i> Postes <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('poste/index') ?>">Liste des postes</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->level == ADMIN_LEVEL || $this->session->level == GST_LEVEL): ?>
                        <!--                    Stock -->
                        <div class="menu_section">
                            <h3>Stocks</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-bug"></i> Statistiques <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('dashboard/gst') ?>">Dashboard</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-building"></i> Demandes <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('demande/index') ?>">Liste des demandes</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-building"></i> Materiels <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('materiel/index') ?>">Liste des materiels</a></li>
                                        <li><a href="<?php echo site_url('categorie_materiel/index') ?>">Categories</a></li>
                                        <li><a href="<?php echo site_url('materiel/rupture') ?>">Rupture</a></li>
                                        <li><a href="<?php echo site_url('materiel/uses') ?>">En utilisation</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-building"></i> Besoins <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('besoin/index') ?>">Lister</a></li>
                                        <li><a href="<?php echo site_url('besoin/create') ?>">Ajouter</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->level == ADMIN_LEVEL): ?>
                        <!--                    Admin  -->
                        <div class="menu_section">
                            <h3>Admin Panel</h3>
                            <ul class="nav side-menu">
                                <li>
                                    <a><i class="fa fa-building"></i> Users <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo site_url('user/index') ?>">Lister</a></li>
                                        <li><a href="<?php echo site_url('user/create') ?>">Ajouter</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Déconnexion" href="<?php echo site_url('auth/logout')?>">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="<?php echo base_url('assets/production/images/user.png') ?>" alt="...">
                                <?php echo strtoupper($this->session->username) ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="<?php site_url('auth/profil') ?>"> Profil</a></li>
                                <li>
                                    <a href="<?php site_url('auth/edit_profil') ?>">
                                        <span>Modifier profil</span>
                                    </a>
                                </li>
                                <li><a href="<?php echo site_url('auth/logout')?>"><i class="fa fa-sign-out pull-right"></i> Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
            <div class="row tile_count">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-users"></i> Total Agents</span>
                    <div class="count"><?php echo $nbAgent ?></div>
                    <span class="count_bottom"><i class="green">4% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Hommes</span>
                    <div class="count"><?php echo $nbHommes ?></div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Femmes</span>
                    <div class="count green"><?php echo $nbFemmes ?></div>
                    <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Taches</span>
                    <div class="count"><?php echo $nbTaches ?></div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Departements</span>
                    <div class="count"><?php echo $nbDepartements ?></div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-clock-o"></i> Moyenne des taches</span>
                    <div class="count"><?php echo $nbTacheMoyen ?></div>
                    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
                </div>
            </div>
            <!-- /top tiles -->

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard_graph">

                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>Network Activities <small>Graph title sub-title</small></h3>
                            </div>
                            <div class="col-md-6">
                                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div id="chart_plot_01" class="demo-placeholder"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                            <div class="x_title">
                                <h2>Top Performance Departement</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-6">
                            <?php
                            foreach ($depTasks as $departement){
                                foreach ($endDepTasks as $endDepTask) {
                                    $t = 0;
                                    if ($endDepTask->nom_departement == $departement->nom_departement){
                                        $t =  ceil(($endDepTask->nbTache * 100) / $departement->nbTache);
                                        break;
                                    }
                                }
                            ?>
                                <div>
                                    <p><?php echo ucwords($departement->nom_departement)." $t%" ?></p>
                                    <div class="">
                                        <div class="progress progress_sm" style="width: 76%;">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $t ?>"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>
            <br />

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <h3 class="pull-left"><i class="fa fa-paw"></i> <?php echo ucwords(APP_NAME) ?></h3>
            <div class="pull-right">
                <p>©<?php echo date('Y'); ?> <?php echo ucwords(APP_NAME) ?> Tous droits réservés | designed by <?php echo ucwords(CODERS) ?></p>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/vendors/fastclick/lib/fastclick.js'); ?>"></script>
<!-- NProgress -->
<script src="<?php echo base_url('assets/vendors/nprogress/nprogress.js'); ?>"></script>
<!-- Chart.js -->
<script src="<?php echo base_url('assets/vendors/Chart.js/dist/Chart.min.js'); ?>"></script>
<!-- gauge.js -->
<script src="<?php echo base_url('assets/vendors/gauge.js/dist/gauge.min.js'); ?>"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/vendors/iCheck/icheck.min.js'); ?>"></script>
<!-- Skycons -->
<script src="<?php echo base_url('assets/vendors/skycons/skycons.js'); ?>"></script>
<!-- Flot -->
<script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.pie.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.time.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.stack.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.resize.js'); ?>"></script>
<!-- Flot plugins -->
<script src="<?php echo base_url('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/flot-spline/js/jquery.flot.spline.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/flot.curvedlines/curvedLines.js'); ?>"></script>
<!-- DateJS -->
<script src="<?php echo base_url('assets/vendors/DateJS/build/date.js'); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('assets/vendors/jqvmap/dist/jquery.vmap.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url('assets/vendors/moment/min/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url('assets/build/js/custom.min.js'); ?>"></script>

</body>
</html>

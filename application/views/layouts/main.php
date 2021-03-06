<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo (isset($title)) ? ucwords($title) : "Tableau de bord" ?> | <?php echo ucwords(APP_NAME) ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url('assets/production/images/favicon.ico') ?>" type="image/x-icon">

    <!-- Datatables -->
    <link href="<?php echo base_url('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet'); ?>">
    <link href="<?php echo base_url('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet'); ?>">
    <link href="<?php echo base_url('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet'); ?>">
    <link href="<?php echo base_url('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet'); ?>">
    <link href="<?php echo base_url('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet'); ?>">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
    <?php if (isset($styles)){
        foreach ($styles as $style) {
            $style = base_url('assets/custom/css/'.$style);
            echo link_tag($style);
        }
    } ?>
    <script src="<?php echo base_url('assets/build/js/sweetalert.all.min.js') ?>"></script>
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
                                    <li><a href="<?php echo site_url('dashboard/grh') ?>">Dashboard</a></li>
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
            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo (isset($title)) ? ucwords($title) : "Tableau de bord" ?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php echo isset($page) ? $page : ""; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/vendors/fastclick/lib/fastclick.js') ?>"></script>
<!-- NProgress -->
<script src="<?php echo base_url('assets/vendors/nprogress/nprogress.js') ?>"></script>

<!-- Datatables -->
<script src="<?php echo base_url('assets/vendors/datatables.net/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-buttons/js/buttons.print.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/jszip/dist/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/pdfmake/build/pdfmake.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/pdfmake/build/vfs_fonts.js');?>"></script>

<!-- morris.js -->
<script src="<?php echo base_url('assets/vendors/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/morris.js/morris.min.js'); ?>"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo  base_url('assets/vendors/moment/min/moment.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo base_url('assets/build/js/custom.js') ?>"></script>

<?php if (isset($javascripts)){
    foreach ($javascripts as $javascript) {
        $javascript = base_url('assets/custom/js/'.$javascript);
        echo "<script type='application/javascript' src='$javascript'></script>";
    }
} ?>

<script>
    function desactiver(id, val) {
        $.get( "active/"+id+"/"+val, function( data ) {
        }).done(function() {
            console.log( "Modifier avec succes !" );
        }).fail(function() {
            alert( "Erreur inattendu ! Veuillez réesayer plutard..." );
        });
    }
</script>
</body>
</html>

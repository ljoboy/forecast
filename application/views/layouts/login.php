<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Connexion | <?php echo ucwords(APP_NAME) ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.min.css'); ?>" rel="stylesheet">
</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php if (isset($this->session->login_error)) : ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert" style="color: #e0e0e0; text-shadow: 0 1px 0 #6c6c6c">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <?php echo $this->session->login_error ?>
                </div>
                <hr/>
                <?php endif; ?>
                <?php echo form_open('auth/login') ?>
                    <h1>Connexion</h1>
                    <div>
                        <input autocomplete="username" class="form-control" name="username" placeholder="Nom d'utlisateur"
                               required="" type="text"/>
                    </div>
                    <div>
                        <input autocomplete="current-password" class="form-control" name="password" placeholder="Mot de passe"
                               required="" type="password"/>
                    </div>
                    <div>
                        <button class="btn btn-default submit">Connexion</button>
                        <a class="reset_pass" href="<?php echo site_url('auth/password_modify') ?>">Mot de passe oublié ?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-paw"></i> <?php echo ucwords(APP_NAME) ?></h1>
                            <p>©<?php echo date('Y'); ?> <?php echo ucwords(APP_NAME) ?> Tous droits réservés | designed by <?php echo ucwords(CODERS) ?></p>
                        </div>
                    </div>
                <?php echo form_close() ?>
            </section>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
</body>
</html>

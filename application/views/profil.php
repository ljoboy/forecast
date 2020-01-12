<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
    <div class="profile_img">
        <div id="crop-avatar">
            <!-- Current avatar -->
            <img class="img-responsive avatar-view" src="<?php echo base_url('assets/production/images/user.png') ?>" alt="Avatar" title="Change the avatar">
        </div>
    </div>
    <h3><?php echo ucfirst($agent->prenom)." ".strtoupper($agent->nom." ".$agent->postnom) ?></h3>

    <ul class="list-unstyled user_data">
        <li title="Adresse">
            <i class="fa fa-map-marker user-profile-icon"></i> <?php echo $agent->adresse ?>
        </li>
        <li title="Poste">
            <i class="fa fa-briefcase user-profile-icon"></i> <?php echo isset($poste) ? strtoupper($poste->nom_poste) : "Agent simple" ?>
        </li>

        <li class="m-top-xs" title="Email">
            <i class="fa fa-external-link user-profile-icon"></i>
            <a href="mailto:<?php echo $agent->email ?>"><?php echo $agent->email ?></a>
        </li>
        <li title="Niveau d'étude">
            <i class="fa fa-university user-profile-icon"></i> <?php echo ucwords($agent->etude_level); ?>
        </li>
        <li title="Departement">
            <i class="fa fa-building user-profile-icon"></i> <?php echo strtoupper($departement->nom_departement) ?>
        </li>
    </ul>

    <a href="<?php echo site_url('agent/update/'.$agent->id_agent) ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Modifier Profil</a>
    <br />

    <!-- start skills -->
    <h4>Langue parler</h4>
<!--    TODO::Un modal pour ajouter la langue et ses tiers -->
    <ul class="list-unstyled user_data">
        <?php
        foreach ($langs as $lang) {
            $nb = ((int) ($lang->comprendre + $lang->lecture + $lang->parler + $lang->ecriture + 10)) * 2;
            echo "<li><p>";
            echo ucwords($lang->nom_langage)." $nb%";
            echo '<div class="progress progress_sm">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="'.$nb.'"></div>
                </div>';
            echo "</li></p>";
        }
        ?>
    </ul>
    <!-- end of skills -->

</div>
<div class="col-md-9 col-sm-9 col-xs-12">

    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Tâches récentes</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Identités</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                <!-- start recent activity -->
                <ul class="messages">
                    <li>
                        <img src="images/img.jpg" class="avatar" alt="Avatar">
                        <div class="message_date">
                            <h3 class="date text-info">24</h3>
                            <p class="month">May</p>
                        </div>
                        <div class="message_wrapper">
                            <h4 class="heading">Desmond Davison</h4>
                            <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                            <br />
                            <p class="url">
                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                            </p>
                        </div>
                    </li>
                    <li>
                        <img src="images/img.jpg" class="avatar" alt="Avatar">
                        <div class="message_date">
                            <h3 class="date text-error">21</h3>
                            <p class="month">May</p>
                        </div>
                        <div class="message_wrapper">
                            <h4 class="heading">Brian Michaels</h4>
                            <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                            <br />
                            <p class="url">
                                <span class="fs1" aria-hidden="true" data-icon=""></span>
                                <a href="#" data-original-title="">Download</a>
                            </p>
                        </div>
                    </li>
                    <li>
                        <img src="images/img.jpg" class="avatar" alt="Avatar">
                        <div class="message_date">
                            <h3 class="date text-info">24</h3>
                            <p class="month">May</p>
                        </div>
                        <div class="message_wrapper">
                            <h4 class="heading">Desmond Davison</h4>
                            <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                            <br />
                            <p class="url">
                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                            </p>
                        </div>
                    </li>
                    <li>
                        <img src="images/img.jpg" class="avatar" alt="Avatar">
                        <div class="message_date">
                            <h3 class="date text-error">21</h3>
                            <p class="month">May</p>
                        </div>
                        <div class="message_wrapper">
                            <h4 class="heading">Brian Michaels</h4>
                            <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                            <br />
                            <p class="url">
                                <span class="fs1" aria-hidden="true" data-icon=""></span>
                                <a href="#" data-original-title="">Download</a>
                            </p>
                        </div>
                    </li>

                </ul>
                <!-- end recent activity -->

            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                <!-- start user projects -->
                <table class="data table table-striped no-margin table-hover">
                    <thead>
                        <tr>
                            <th>Denomination</th>
                            <th>Information</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr><td>Nom</td><td><?php echo strtoupper($agent->nom); ?></td></tr>
                    <tr><td>Postnom</td><td><?php echo strtoupper($agent->postnom); ?></td></tr>
                    <tr><td>Prenom</td><td><?php echo ucwords($agent->prenom); ?></td></tr>
                    <tr><td>Etat Civil</td><td><?php echo ucwords($agent->etat_civil); ?></td></tr>
                    <tr><td>Matricule</td><td><?php echo strtoupper($agent->matricule); ?></td></tr>
                    <tr><td>Adresse</td><td><?php echo $agent->adresse; ?></td></tr>
                    <tr><td>Email</td><td><?php echo $agent->email; ?></td></tr>
                    <tr><td>Date De Naissance</td><td><?php echo $agent->date_de_naissance; ?></td></tr>
                    <tr><td>Lieu De Naissance</td><td><?php echo ucwords($agent->lieu_de_naissance); ?></td></tr>
                    <tr><td>Telephone</td><td><?php echo $agent->telephone; ?></td></tr>
                    <tr><td>Genre</td><td><?php echo ucwords($agent->genre); ?></td></tr>
                    <tr><td>Date Entree</td><td><?php echo nice_date($agent->date_entree, 'd-m-Y'); ?></td></tr>
                    <tr><td>Date Confirmation</td><td><?php echo nice_date($agent->date_confirmation, 'd-m-Y'); ?></td></tr>
                    <tr><td>Ville</td><td><?php echo ucwords($agent->ville); ?></td></tr>
                    <tr><td>Province</td><td><?php echo ucwords($agent->province); ?></td></tr>
                    <tr><td>Pays</td><td><?php echo strtoupper($agent->pays); ?></td></tr>
                    </tbody>
                </table>
                <!-- end user projects -->

            </div>
        </div>
    </div>
</div>

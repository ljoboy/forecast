<!-- start project list -->
<?php echo anchor(site_url('tache/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
<table class="table table-striped projects">
    <thead>
    <tr>
        <th style="width: 1%">#</th>
        <th style="width: 20%">Project Name</th>
        <th>Team Members</th>
        <th>Project Progress</th>
        <th>Status</th>
        <th style="width: 20%">#Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    $now = new DateTime();
    foreach ($taches as $tache) {
        ++$i;
        $couleurs = array('info', 'success', 'warning', 'danger');
        $etat_text = array('Encours', 'Fini', 'Non commencer', 'Depasser');
        $debut = new DateTime($tache->date_debut);
        $fin = new DateTime($tache->date_fin);
        $ecart = 100;
        if ($fin >= $now){
            $diff = $debut->diff($fin);
            if ($diff->days != 0 && $diff->days != null){
                $now_diff = $debut->diff(new DateTime());
                $ecart = (int) (($now_diff->days * 100) / $diff->days);
            }

        }
        if ($tache->etat == 1){
            $etat = TACHE_FINI;
        }elseif($tache->etat == 0){
            if ($fin < $now){
                $etat = TACHE_DEPASSER;
            }elseif($debut > $now){
                $etat = TACHE_NON_COMMENCER;
            }else{
                $etat = TACHE_ENCOURS;
            }
        }
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td>
                <a href="#"><?php echo ucwords($tache->tache) ?></a>
                <br />
                <small>Crée le <?php echo nice_date($tache->date_assignement, 'd-m-Y') ?></small>
            </td>
            <td>
                <ul class="list-inline">
                    <li>
                        <img src="<?php echo base_url('assets/production/images/user.png') ?>" class="avatar" alt="Avatar">
                    </li>
                    <li>
                        <img src="<?php echo base_url('assets/production/images/user.png') ?>" class="avatar" alt="Avatar">
                    </li>
                    <li>
                        <img src="<?php echo base_url('assets/production/images/user.png') ?>" class="avatar" alt="Avatar">
                    </li>
                    <li>
                        <img src="<?php echo base_url('assets/production/images/user.png') ?>" class="avatar" alt="Avatar">
                    </li>
                </ul>
            </td>
            <td class="project_progress">
                <div class="progress progress_sm">
                    <div class="progress-bar progress-bar-<?php echo $couleurs[$etat]; ?>" role="progressbar" data-transitiongoal="<?php echo $ecart ?>"></div>
                </div>
                <small><?php echo $ecart ?>% Complete</small>
            </td>
            <td>
                <button type="button" class="btn btn-<?php echo $couleurs[$etat]; ?> btn-xs"><?php echo $etat_text[$etat] ?></button>
            </td>
            <td>
                <!--                        <a href="--><?php //echo site_url('tache/read/'.$tache->id_tache) ?><!--" class="btn btn-primary btn-xs" title="Voir"><i class="fa fa-folder"></i> </a>-->
                <?php
                if ($etat == TACHE_ENCOURS || $etat == TACHE_NON_COMMENCER):
                    ?>
                    <a href="<?php echo site_url('tache/update/'.$tache->id_tache) ?>" class="btn btn-info btn-xs" title="Modifier"><i class="fa fa-pencil"></i> </a>
                <?php endif; ?>
                <a onclick="return confirm('Êtes-vous sûr de vouloir effacer ?')" href="<?php echo site_url('tache/delete/'.$tache->id_tache) ?>" class="btn btn-danger btn-xs" title="Effacer"><i class="fa fa-trash-o"></i> </a>
            </td>
        </tr>
    <?php }
    ?>
    </tbody>
</table>
<!-- end project list -->

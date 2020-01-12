<div class="x_content">

    <p>Liste des materiels en cours d'utilisation</p>

    <!-- start project list -->
    <table class="table table-striped projects">
        <thead>
        <tr>
            <th style="width: 1%">#</th>
            <th style="width: 20%">Materiel</th>
            <th>Agent</th>
            <th>Barre de progression</th>
            <th>Etat</th>
            <th style="width: 20%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $nb = 0;
        $now = new DateTime();
        foreach ($uses as $use) {
            $agent = $this->Agent_model->get_by_id($use->agent_id_agent);
            $couleurs = array('info', 'success', 'warning', 'danger');
            $etat_text = array('Encours', 'Fini', 'Non encours', 'Depasser');
            $debut = new DateTime($use->date_debut);
            $fin = new DateTime($use->date_fin);
            $ecart = 100;

            if ($fin < $now){
                $etat = TACHE_DEPASSER;
            }elseif($debut > $now){
                $etat = TACHE_NON_COMMENCER;
                $ecart = 0;
            }else{
                $etat = TACHE_ENCOURS;
                $diff = $debut->diff($fin);
                if ($diff->days != 0 && $diff->days != null){
                    $now_diff = $debut->diff(new DateTime());
                    $ecart = (int) (($now_diff->days * 100) / $diff->days);
                }
            }
            ?>
        <tr>
            <td><?php ++$nb ?></td>
            <td>
                <a><?php echo strtoupper($agent->nom." ".$agent->postnom)." ".ucfirst($agent->prenom) ?></a>
                <br />
                <small>Demandé le <?php echo nice_date($use->date_creation_demande, 'd-m-Y') ?></small>
            </td>
            <td>
                <ul class="list-inline">
                    <li title="<?php echo strtoupper($agent->nom.' '.$agent->postnom).' '.ucfirst($agent->prenom) ?>">
                        <a href="<?php echo site_url('agent/profil/'.$use->agent_id_agent) ?>">
                            <img src="<?php echo base_url('assets/production/images/user.png') ?>" class="avatar" alt="Avatar">
                        </a>
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
                <a href="<?php echo site_url('demande/delete/'. $use->num_demande) ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Réccuperer </a>
            </td>
        </tr><?php
        }
        ?>
        </tbody>
    </table>
    <!-- end project list -->

</div>

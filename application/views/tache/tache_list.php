        <!-- start project list -->
        <?php echo anchor(site_url('tache/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">#</th>
                    <th style="width: 20%">Project Name</th>
                    <th>Team Members</th>
                    <th>Département</th>
                    <th>Project Progress</th>
                    <th>Etat</th>
                    <th style="width: 20%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            $now = new DateTime();
            foreach ($taches as $tache) {
                ++$i;
                $departement = $this->Departement_model->get_by_id($tache->departement_id_departement);
                $couleurs = array('info', 'success', 'warning', 'danger');
                $etat_text = array('Encours', 'Fini', 'Non commencer', 'Depasser');
                $debut = new DateTime($tache->date_debut);
                $fin = new DateTime($tache->date_fin);
                $ecart = 100;

                if ($tache->etat == 1){
                    $etat = TACHE_FINI;
                }elseif($tache->etat == 0){
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
                            <?php
                            foreach ($affectes as $affecte) {
                                if ($affecte->tache_id_tache == $tache->id_tache){
                                    $agent = $this->Agent_model->get_by_id($affecte->agent_id_agent);
                                ?>
                            <li title="<?php echo strtoupper($agent->nom.' '.$agent->postnom).' '.ucfirst($agent->prenom) ?>">
                                <a href="<?php echo site_url('agent/profil/'.$affecte->agent_id_agent) ?>">
                                    <img src="<?php echo base_url('assets/production/images/user.png') ?>" class="avatar" alt="Avatar">
                                </a>
                            </li>
                            <?php }
                            }
                            ?>
                        </ul>
                    </td>
                    <td>
                        <?php echo ucfirst($departement->nom_departement) ?>
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
                        <?php
                        if ($etat == TACHE_ENCOURS || $etat == TACHE_NON_COMMENCER):
                            ?>
                        <a href="<?php echo site_url('agent_has_tache/create/'.$tache->id_tache) ?>" class="btn btn-default btn-xs" title="Affecter"><i class="fa fa-user"></i></a>
                        <a href="<?php echo site_url('tache/update/'.$tache->id_tache) ?>" class="btn btn-info btn-xs" title="Modifier"><i class="fa fa-pencil"></i></a>
                        <?php
                        endif;
                        if ($etat != TACHE_NON_COMMENCER && $etat != TACHE_FINI):
                        ?>
                            <a onclick="return confirm('Êtes-vous sûr que la tache est finie ?')" href="<?php echo site_url('tache/finir/'.$tache->id_tache) ?>" class="btn btn-primary btn-xs" title="Finir"><i class="fa fa-folder"></i></a>
                        <?php endif; ?>
                        <a onclick="return confirm('Êtes-vous sûr de vouloir effacer ?')" href="<?php echo site_url('tache/delete/'.$tache->id_tache) ?>" class="btn btn-danger btn-xs" title="Effacer"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php }
            ?>
            </tbody>
        </table>
        <!-- end project list -->

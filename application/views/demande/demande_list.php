        <div class="row">
            <div class="col-md-4">
                <?php echo anchor(site_url('demande/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Agent demandant</th>
                    <th>Materiel Demandé</th>
                    <th>Quantité Demandée</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Motivation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($demande_data as $demande)
                {
                    $agent = $this->Agent_model->get_by_id($demande->agent_id_agent);
                    $materiel = $this->Materiel_model->get_by_id($demande->code_materiel);
                    ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo strtoupper($agent->nom." ".$agent->postnom)." ".ucfirst($agent->prenom) ?></td>
                        <td><?php echo $materiel->designation_materiel ?></td>
                        <td><?php echo $demande->quantite_demande ?></td>
                        <td><?php echo nice_date($demande->date_debut, 'd-m-Y') ?></td>
                        <td><?php echo nice_date($demande->date_fin, 'd-m-Y') ?></td>
                        <td><?php echo ucfirst($demande->description_demande) ?></td>
                        <td style="text-align:center" width="200px">
                            <?php
                            echo anchor(site_url('demande/accepted/'.$demande->num_demande),'<i class="fa fa-check"></i> Accepter','class="btn btn-success btn-xs"');
                            echo anchor(site_url('demande/delete/'.$demande->num_demande),'<i class="fa fa-trash-o"></i> Refuser','onclick="Javascript: return confirm(\'Etes-vous sure ?\')" class="btn btn-danger btn-xs"');
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
            <?php echo anchor(site_url('demande/excel'), 'Excel', 'class="btn btn-primary"'); ?>
            </div>
        </div>

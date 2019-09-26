
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('agent/create'),'Ajouter', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <?php echo anchor(site_url('agent/excel'), 'Excel', 'class="btn btn-primary" style="float: right"'); ?>
            </div>
        </div>
        <hr/>
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nom</th>
                    <th>Postnom</th>
                    <th>Prenom</th>
                    <th>Etat Civil</th>
                    <th>Matricule</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th>Date De Naissance</th>
                    <th>Lieu De Naissance</th>
                    <th>Telephone</th>
                    <th>Genre</th>
                    <th>Date Entree</th>
                    <th>Date Confirmation</th>
                    <th>Ville</th>
                    <th>Province</th>
                    <th>Pays</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($agent_data as $agent)
                {
                    ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo strtoupper($agent->nom) ?></td>
                        <td><?php echo ucfirst($agent->postnom) ?></td>
                        <td><?php echo ucfirst($agent->prenom) ?></td>
                        <td><?php echo ucfirst($agent->etat_civil) ?></td>
                        <td><?php echo strtoupper($agent->matricule) ?></td>
                        <td><?php echo $agent->adresse ?></td>
                        <td><?php echo $agent->email ?></td>
                        <td><?php echo nice_date($agent->date_de_naissance, 'd-m-Y') ?></td>
                        <td><?php echo ucfirst($agent->lieu_de_naissance) ?></td>
                        <td><?php echo $agent->telephone ?></td>
                        <td><?php echo ucfirst($agent->genre) ?></td>
                        <td><?php echo nice_date($agent->date_entree, 'd-m-Y') ?></td>
                        <td><?php echo nice_date($agent->date_confirmation, 'd-m-Y') ?></td>
                        <td><?php echo ucfirst($agent->ville) ?></td>
                        <td><?php echo ucfirst($agent->province) ?></td>
                        <td><?php echo strtoupper($agent->pays) ?></td>
                        <td>
                            <?php
                            echo anchor(site_url('agent/profil/'.$agent->id_agent),'Profil');
                            echo ' | ';
                            echo anchor(site_url('agent/update/'.$agent->id_agent),'Modifier');
                            echo ' | ';
                            echo anchor(site_url('agent/delete/'.$agent->id_agent),'Effacer','onclick="javascript: return confirm(\'Etes-vous sure ?\')"');
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

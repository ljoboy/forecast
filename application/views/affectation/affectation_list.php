        <div class="row">
            <div class="col-md-4">
                <?php echo anchor(site_url('affectation/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date Affectation</th>
                    <th>Is Actif</th>
                    <th>Agent Id Agent</th>
                    <th>Poste Id Poste</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($affectation_data as $affectation)
            {
                ?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $affectation->date_affectation ?></td>
                    <td><?php echo $affectation->is_actif ?></td>
                    <td><?php echo $affectation->agent_id_agent ?></td>
                    <td><?php echo $affectation->poste_id_poste ?></td>
                    <td style="text-align:center" width="200px">
                        <?php
                        echo anchor(site_url('affectation/read/'.$affectation->id_affectation),'Read');
                        echo ' | ';
                        echo anchor(site_url('affectation/update/'.$affectation->id_affectation),'Update');
                        echo ' | ';
                        echo anchor(site_url('affectation/delete/'.$affectation->id_affectation),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Date Affectation</th>
                    <th>Is Actif</th>
                    <th>Agent Id Agent</th>
                    <th>Poste Id Poste</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        <div class="row">
            <div class="col-md-6">
		<?php echo anchor(site_url('affectation/excel'), 'Excel', 'class="btn btn-primary"'); ?>

            </div>
        </div>

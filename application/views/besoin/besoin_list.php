
        <div class="row">
            <div class="col-md-4">
                <?php echo anchor(site_url('besoin/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Quantite Besoin</th>
                    <th>Nom Materiel</th>
                    <th>Prix Unitaire Besoin</th>
                    <th>Details Besoin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($besoin_data as $besoin)
            {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo (int) $besoin->quantite_besoin ?></td>
                    <td><?php echo $besoin->nom_materiel ?></td>
                    <td><?php echo $besoin->prix_unitaire_besoin ?></td>
                    <td><?php echo $besoin->details_besoin ?></td>
                    <td>
                        <?php
                        echo anchor(site_url('besoin/update/'.$besoin->id_besoin),'Modifier');
                        echo ' | ';
                        echo anchor(site_url('besoin/delete/'.$besoin->id_besoin),'Effacer','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('besoin/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <?php echo anchor(site_url('categorie_materiel/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nom</th>
                    <th>Date Creation</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $nb = 0;
            foreach ($categorie_materiel_data as $categorie_materiel)
            {
                ?>
                <tr>
                    <td><?php echo ++$nb ?></td>
                    <td><?php echo $categorie_materiel->nom_cat_mat ?></td>
                    <td><?php echo $categorie_materiel->date_creation_cat ?></td>
                    <td><?php echo $categorie_materiel->details_cat_ma ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
		<?php echo anchor(site_url('categorie_materiel/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
        </div>

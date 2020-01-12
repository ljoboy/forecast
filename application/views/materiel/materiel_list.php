
        <div class="row">
            <div class="col-md-4">
                <?php echo anchor(site_url('materiel/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Designation Materiel</th>
                    <th>Quantite Stock</th>
                    <th>Stock Min</th>
                    <th>Details</th>
                    <th>Fournisseur</th>
                    <th>Categorie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $nb = 0;
            foreach ($materiel_data as $materiel)
            {
                foreach ($fournisseurs as $fournisseur) {
                    if ($fournisseur->id_fournisseur == $materiel->fournisseur_id_fournisseur){
                        $f = $fournisseur->reference_fornisseur;
                        break;
                    }
                }
                foreach ($categories as $category) {
                    if ($category->id_cat_mat == $materiel->categorie_materiel_id_cat_mat){
                        $c = $category->nom_cat_mat;
                    }
                }
                $qte = (int) $materiel->quantite_stock;
                $min = (int) $materiel->stock_min;
                ?>
                <tr class="<?php echo ($qte <= $min) ? 'bg-danger' : '' ?>">
                    <td width="80px"><?php echo ++$nb ?></td>
                    <td><?php echo $materiel->designation_materiel ?></td>
                    <td><?php echo $qte ?></td>
                    <td><?php echo $min ?></td>
                    <td><?php echo $materiel->details ?></td>
                    <td><?php echo isset($f) ? $f : "" ?></td>
                    <td><?php echo $c ?></td>
                    <td style="text-align:center" width="200px">
                        <a href="<?php echo site_url('sortie/create/'.$materiel->code_materiel) ?>" class="btn btn-danger btn-xs"><i class="fa fa-sign-out"></i> Sortie</a>
                        <a href="<?php echo site_url('entree/create/'.$materiel->code_materiel) ?>" class="btn btn-primary btn-xs"><i class="fa fa-sign-in"></i> Entre&eacute;e</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
		<?php echo anchor(site_url('materiel/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>

        </div>

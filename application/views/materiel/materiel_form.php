
        <h2 style="margin-top:0px">Materiel <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Designation Materiel <?php echo form_error('designation_materiel') ?></label>
            <input type="text" class="form-control" name="designation_materiel" id="designation_materiel" placeholder="Designation Materiel" value="<?php echo $designation_materiel; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Quantite Stock <?php echo form_error('quantite_stock') ?></label>
            <input type="text" class="form-control" name="quantite_stock" id="quantite_stock" placeholder="Quantite Stock" value="<?php echo $quantite_stock; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Stock Min <?php echo form_error('stock_min') ?></label>
            <input type="text" class="form-control" name="stock_min" id="stock_min" placeholder="Stock Min" value="<?php echo $stock_min; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Details <?php echo form_error('details') ?></label>
            <input type="text" class="form-control" name="details" id="details" placeholder="Details" value="<?php echo $details; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Etat Materiel <?php echo form_error('etat_materiel') ?></label>
            <input type="text" class="form-control" name="etat_materiel" id="etat_materiel" placeholder="Etat Materiel" value="<?php echo $etat_materiel; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Fournisseur Id Fournisseur <?php echo form_error('fournisseur_id_fournisseur') ?></label>
            <input type="text" class="form-control" name="fournisseur_id_fournisseur" id="fournisseur_id_fournisseur" placeholder="Fournisseur Id Fournisseur" value="<?php echo $fournisseur_id_fournisseur; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Categorie Materiel Id Cat Mat <?php echo form_error('categorie_materiel_id_cat_mat') ?></label>
            <input type="text" class="form-control" name="categorie_materiel_id_cat_mat" id="categorie_materiel_id_cat_mat" placeholder="Categorie Materiel Id Cat Mat" value="<?php echo $categorie_materiel_id_cat_mat; ?>" />
        </div>
	    <input type="hidden" name="code_materiel" value="<?php echo $code_materiel; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('materiel') ?>" class="btn btn-default">Cancel</a>
	</form>

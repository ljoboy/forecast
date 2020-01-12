<?php echo validation_errors('<div class="error">', '</div>'); ?>
    <?php echo form_open($action) ?>
	    <div class="form-group">
            <label for="int">Quantite Entree <?php echo form_error('quantite_entree') ?></label>
            <div class="form-horizontal form-label-left input_mask">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="number" min="1" class="form-control" name="quantite_entree" id="quantite_entree" placeholder="Quantite Entree" value="<?php echo $quantite_entree; ?>" />
                </div>
                <div class="col-md-4 col-sm-4 col-xs-8 form-group has-feedback">
                    <input type="text" class="form-control" id="inputSuccess3" placeholder="<?php echo $materiel->designation_materiel ?>" readonly>
                </div>
                <div class="col-md-2 col-sm-2 col-xs- form-group has-feedback">
                    <input type="text" class="form-control" name="qte_stock" value="<?php echo (int) $materiel->quantite_stock ?>" readonly>
                </div>
            </div>
        </div>
	    <div class="form-group">
            <label for="datetime">Date Entree <?php echo form_error('date_entree') ?></label>
            <input type="date" max="<?php echo date('Y-m-d') ?>" class="form-control" name="date_entree" id="date_entree" placeholder="Date Entree" value="<?php echo $date_entree; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Prix Unitaire <?php echo form_error('prix_unitaire') ?></label>
            <input type="number" min="0" class="form-control" name="prix_unitaire" id="prix_unitaire" placeholder="Prix Unitaire" value="<?php echo $prix_unitaire; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description Entree <?php echo form_error('description_entree') ?></label>
            <input type="text" class="form-control" name="description_entree" id="description_entree" placeholder="Description Entree" value="<?php echo $description_entree; ?>" />
        </div>
        <input type="hidden" name="materiel_code_materiel" value="<?php echo $materiel->code_materiel; ?>" />

	    <input type="hidden" name="id_entree" value="<?php echo $id_entree; ?>" /> 
	    <button type="submit" class="btn btn-primary">Ajouter</button>
	    <a href="<?php echo site_url('materiel') ?>" class="btn btn-default">Cancel</a>
	<?php echo form_close() ?>

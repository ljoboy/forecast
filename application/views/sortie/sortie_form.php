
    <?php echo form_open($action) ?>
	    <div class="form-group">
            <label for="datetime" class="control-label">Date Sortie <?php echo form_error('date_sortie') ?></label>
            <input type="date" max="<?php echo date('Y-m-d') ?>" class="form-control" name="date_sortie" id="date_sortie" placeholder="Date Sortie" value="<?php echo $date_sortie; ?>" />
        </div>
        <div class="form-group">
            <label for="qte_sortie" class="control-label">Quantit&eacute; à sortir <?php echo form_error('qte_sortie') ?></label>
            <div class="form-horizontal form-label-left input_mask">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input min="1" max="<?php echo (int) $materiel->quantite_stock ?>" type="number" class="form-control" name="qte_sortie" id="qte_sortie" placeholder="Quantit&eacute; à sortir" value="<?php echo $qte_sortie; ?>" />
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
            <label for="varchar">Motif Sortie <?php echo form_error('motif_sortie') ?></label>
            <input type="text" class="form-control" name="motif_sortie" id="motif_sortie" placeholder="Motif Sortie" value="<?php echo $motif_sortie; ?>" />
        </div>

        <input type="hidden"  name="materiel_code_materiel" id="materiel_code_materiel" value="<?php echo $materiel->code_materiel; ?>" />
	    <input type="hidden" name="id_sortie" value="<?php echo $id_sortie; ?>" /> 
	    <button type="submit" class="btn btn-primary">Ajouter</button>
	    <a href="<?php echo site_url('materiel') ?>" class="btn btn-default">Retour</a>
	<?php echo form_close() ?>


        <h2 style="margin-top:0px">Details_demande <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Quantite Demande <?php echo form_error('quantite_demande') ?></label>
            <input type="text" class="form-control" name="quantite_demande" id="quantite_demande" placeholder="Quantite Demande" value="<?php echo $quantite_demande; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Demande Num Demande <?php echo form_error('demande_num_demande') ?></label>
            <input type="text" class="form-control" name="demande_num_demande" id="demande_num_demande" placeholder="Demande Num Demande" value="<?php echo $demande_num_demande; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Materiel Code Materiel <?php echo form_error('materiel_code_materiel') ?></label>
            <input type="text" class="form-control" name="materiel_code_materiel" id="materiel_code_materiel" placeholder="Materiel Code Materiel" value="<?php echo $materiel_code_materiel; ?>" />
        </div>
	    <input type="hidden" name="id_details_demande" value="<?php echo $id_details_demande; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('details_demande') ?>" class="btn btn-default">Cancel</a>
	</form>

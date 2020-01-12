
        <h2 style="margin-top:0px">Categorie_materiel <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nom Cat Mat <?php echo form_error('nom_cat_mat') ?></label>
            <input type="text" class="form-control" name="nom_cat_mat" id="nom_cat_mat" placeholder="Nom Cat Mat" value="<?php echo $nom_cat_mat; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Date Creation Cat <?php echo form_error('date_creation_cat') ?></label>
            <input type="text" class="form-control" name="date_creation_cat" id="date_creation_cat" placeholder="Date Creation Cat" value="<?php echo $date_creation_cat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Details Cat Ma <?php echo form_error('details_cat_ma') ?></label>
            <input type="text" class="form-control" name="details_cat_ma" id="details_cat_ma" placeholder="Details Cat Ma" value="<?php echo $details_cat_ma; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Etat Cat Mat <?php echo form_error('etat_cat_mat') ?></label>
            <input type="text" class="form-control" name="etat_cat_mat" id="etat_cat_mat" placeholder="Etat Cat Mat" value="<?php echo $etat_cat_mat; ?>" />
        </div>
	    <input type="hidden" name="id_cat_mat" value="<?php echo $id_cat_mat; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('categorie_materiel') ?>" class="btn btn-default">Cancel</a>
	</form>

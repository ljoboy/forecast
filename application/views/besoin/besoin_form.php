
        <h2 style="margin-top:0px">Besoin <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Quantite Besoin <?php echo form_error('quantite_besoin') ?></label>
            <input type="number" class="form-control" name="quantite_besoin" id="quantite_besoin" placeholder="Quantite Besoin" value="<?php echo $quantite_besoin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nom Materiel <?php echo form_error('nom_materiel') ?></label>
            <input type="text" class="form-control" name="nom_materiel" id="nom_materiel" placeholder="Nom Materiel" value="<?php echo $nom_materiel; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Prix Unitaire Besoin <?php echo form_error('prix_unitaire_besoin') ?></label>
            <input type="number" class="form-control" name="prix_unitaire_besoin" id="prix_unitaire_besoin" placeholder="Prix Unitaire Besoin" value="<?php echo $prix_unitaire_besoin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Details Besoin <?php echo form_error('details_besoin') ?></label>
            <input type="text" class="form-control" name="details_besoin" id="details_besoin" placeholder="Details Besoin" value="<?php echo $details_besoin; ?>" />
        </div>
	    <input type="hidden" name="id_besoin" value="<?php echo $id_besoin; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('besoin') ?>" class="btn btn-default">Cancel</a>
	</form>

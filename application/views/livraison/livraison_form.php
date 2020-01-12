
        <h2 style="margin-top:0px">Livraison <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Quantite Livree <?php echo form_error('quantite_livree') ?></label>
            <input type="text" class="form-control" name="quantite_livree" id="quantite_livree" placeholder="Quantite Livree" value="<?php echo $quantite_livree; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Date Livraison <?php echo form_error('date_livraison') ?></label>
            <input type="text" class="form-control" name="date_livraison" id="date_livraison" placeholder="Date Livraison" value="<?php echo $date_livraison; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Date Creation <?php echo form_error('date_creation') ?></label>
            <input type="text" class="form-control" name="date_creation" id="date_creation" placeholder="Date Creation" value="<?php echo $date_creation; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Sortie Id Sortie <?php echo form_error('sortie_id_sortie') ?></label>
            <input type="text" class="form-control" name="sortie_id_sortie" id="sortie_id_sortie" placeholder="Sortie Id Sortie" value="<?php echo $sortie_id_sortie; ?>" />
        </div>
	    <input type="hidden" name="id_livraison" value="<?php echo $id_livraison; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('livraison') ?>" class="btn btn-default">Cancel</a>
	</form>

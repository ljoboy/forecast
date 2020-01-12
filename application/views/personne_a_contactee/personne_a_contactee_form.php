
        <h2 style="margin-top:0px">Personne_a_contactee <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nom Complet <?php echo form_error('nom_complet') ?></label>
            <input type="text" class="form-control" name="nom_complet" id="nom_complet" placeholder="Nom Complet" value="<?php echo $nom_complet; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Telephone <?php echo form_error('telephone') ?></label>
            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone" value="<?php echo $telephone; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Relation <?php echo form_error('relation') ?></label>
            <input type="text" class="form-control" name="relation" id="relation" placeholder="Relation" value="<?php echo $relation; ?>" />
        </div>
	    <input type="hidden" name="id_personne_a_contactee" value="<?php echo $id_personne_a_contactee; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('personne_a_contactee') ?>" class="btn btn-default">Cancel</a>
	</form>

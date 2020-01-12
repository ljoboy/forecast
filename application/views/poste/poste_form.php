
        <h2 style="margin-top:0px">Poste <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nom Poste <?php echo form_error('nom_poste') ?></label>
            <input type="text" class="form-control" name="nom_poste" id="nom_poste" placeholder="Nom Poste" value="<?php echo $nom_poste; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Type <?php echo form_error('type') ?></label>
            <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="<?php echo $type; ?>" />
        </div>
	    <input type="hidden" name="id_poste" value="<?php echo $id_poste; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('poste') ?>" class="btn btn-default">Cancel</a>
	</form>

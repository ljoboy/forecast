
        <h2 style="margin-top:0px">Departement <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nom Departement <?php echo form_error('nom_departement') ?></label>
            <input type="text" class="form-control" name="nom_departement" id="nom_departement" placeholder="Nom Departement" value="<?php echo $nom_departement; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
        </div>
	    <input type="hidden" name="id_departement" value="<?php echo $id_departement; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('departement') ?>" class="btn btn-default">Cancel</a>
	</form>

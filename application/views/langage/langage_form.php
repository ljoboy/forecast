
        <h2 style="margin-top:0px">Langage <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nom Langage <?php echo form_error('nom_langage') ?></label>
            <input type="text" class="form-control" name="nom_langage" id="nom_langage" placeholder="Nom Langage" value="<?php echo $nom_langage; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Connaissances Linguistiques Id Langue Parler <?php echo form_error('connaissances_linguistiques_id_langue_parler') ?></label>
            <input type="text" class="form-control" name="connaissances_linguistiques_id_langue_parler" id="connaissances_linguistiques_id_langue_parler" placeholder="Connaissances Linguistiques Id Langue Parler" value="<?php echo $connaissances_linguistiques_id_langue_parler; ?>" />
        </div>
	    <input type="hidden" name="id_langage" value="<?php echo $id_langage; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('langage') ?>" class="btn btn-default">Cancel</a>
	</form>

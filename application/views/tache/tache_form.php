
        <h2 style="margin-top:0px">Tache <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Tache <?php echo form_error('tache') ?></label>
            <input type="text" class="form-control" name="tache" id="tache" placeholder="Tache" value="<?php echo $tache; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Date Debut <?php echo form_error('date_debut') ?></label>
            <input type="text" class="form-control" name="date_debut" id="date_debut" placeholder="Date Debut" value="<?php echo $date_debut; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Date Fin <?php echo form_error('date_fin') ?></label>
            <input type="text" class="form-control" name="date_fin" id="date_fin" placeholder="Date Fin" value="<?php echo $date_fin; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Date Assignement <?php echo form_error('date_assignement') ?></label>
            <input type="text" class="form-control" name="date_assignement" id="date_assignement" placeholder="Date Assignement" value="<?php echo $date_assignement; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Etat <?php echo form_error('etat') ?></label>
            <input type="text" class="form-control" name="etat" id="etat" placeholder="Etat" value="<?php echo $etat; ?>" />
        </div>
	    <div class="form-group">
            <label for="details">Details <?php echo form_error('details') ?></label>
            <textarea class="form-control" rows="3" name="details" id="details" placeholder="Details"><?php echo $details; ?></textarea>
        </div>
	    <input type="hidden" name="id_tache" value="<?php echo $id_tache; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tache') ?>" class="btn btn-default">Cancel</a>
	</form>


        <h2 style="margin-top:0px">Affectation <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="date">Date Affectation <?php echo form_error('date_affectation') ?></label>
            <input type="text" class="form-control" name="date_affectation" id="date_affectation" placeholder="Date Affectation" value="<?php echo $date_affectation; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Is Actif <?php echo form_error('is_actif') ?></label>
            <input type="text" class="form-control" name="is_actif" id="is_actif" placeholder="Is Actif" value="<?php echo $is_actif; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Agent Id Agent <?php echo form_error('agent_id_agent') ?></label>
            <input type="text" class="form-control" name="agent_id_agent" id="agent_id_agent" placeholder="Agent Id Agent" value="<?php echo $agent_id_agent; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Poste Id Poste <?php echo form_error('poste_id_poste') ?></label>
            <input type="text" class="form-control" name="poste_id_poste" id="poste_id_poste" placeholder="Poste Id Poste" value="<?php echo $poste_id_poste; ?>" />
        </div>
	    <input type="hidden" name="id_affectation" value="<?php echo $id_affectation; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('affectation') ?>" class="btn btn-default">Cancel</a>
	</form>

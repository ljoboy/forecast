
        <h2 style="margin-top:0px">Conge <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Type <?php echo form_error('type') ?></label>
            <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="<?php echo $type; ?>" />
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
            <label for="varchar">Details <?php echo form_error('details') ?></label>
            <input type="text" class="form-control" name="details" id="details" placeholder="Details" value="<?php echo $details; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Agent Id Agent <?php echo form_error('agent_id_agent') ?></label>
            <input type="text" class="form-control" name="agent_id_agent" id="agent_id_agent" placeholder="Agent Id Agent" value="<?php echo $agent_id_agent; ?>" />
        </div>
	    <input type="hidden" name="id_conge" value="<?php echo $id_conge; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('conge') ?>" class="btn btn-default">Cancel</a>
	</form>

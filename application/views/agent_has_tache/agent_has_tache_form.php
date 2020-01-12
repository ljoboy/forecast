    <?php echo form_open($action) ?>
    <div class="form-group">
        <label for="">Choisissez les agents à assignés à cette tache <small>(Maintenez la touche controle pour ajouter plusieurs agents)</small></label>
        <select class="form-control" name="agent_id_agent[]" id="" multiple="multiple">
            <?php
            foreach ($agents as $agent) {
                ?>
                <option value="<?php echo $agent->id_agent ?>"><?php echo strtoupper($agent->nom." ".$agent->postnom)." ".ucfirst($agent->prenom) ?></option>
                <?php
            }
            ?>
        </select>
    </div>

	    <button type="submit" class="btn btn-primary">Affecter</button>
	    <a href="<?php echo site_url('tache/index') ?>" class="btn btn-default">Retour</a>
	<?php echo form_close() ?>

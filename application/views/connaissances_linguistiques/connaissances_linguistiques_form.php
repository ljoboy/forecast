
        <h2 style="margin-top:0px">Connaissances_linguistiques <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Lecture <?php echo form_error('lecture') ?></label>
            <input type="text" class="form-control" name="lecture" id="lecture" placeholder="Lecture" value="<?php echo $lecture; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ecriture <?php echo form_error('ecriture') ?></label>
            <input type="text" class="form-control" name="ecriture" id="ecriture" placeholder="Ecriture" value="<?php echo $ecriture; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Parler <?php echo form_error('parler') ?></label>
            <input type="text" class="form-control" name="parler" id="parler" placeholder="Parler" value="<?php echo $parler; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Comprendre <?php echo form_error('comprendre') ?></label>
            <input type="text" class="form-control" name="comprendre" id="comprendre" placeholder="Comprendre" value="<?php echo $comprendre; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Agent Id Agent <?php echo form_error('agent_id_agent') ?></label>
            <input type="text" class="form-control" name="agent_id_agent" id="agent_id_agent" placeholder="Agent Id Agent" value="<?php echo $agent_id_agent; ?>" />
        </div>
	    <input type="hidden" name="id_langue_parler" value="<?php echo $id_langue_parler; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('connaissances_linguistiques') ?>" class="btn btn-default">Cancel</a>
	</form>


        <h2 style="margin-top:0px">Fournisseur <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Reference Fornisseur <?php echo form_error('reference_fornisseur') ?></label>
            <input type="text" class="form-control" name="reference_fornisseur" id="reference_fornisseur" placeholder="Reference Fornisseur" value="<?php echo $reference_fornisseur; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Adresse Fournissseur <?php echo form_error('adresse_fournissseur') ?></label>
            <input type="text" class="form-control" name="adresse_fournissseur" id="adresse_fournissseur" placeholder="Adresse Fournissseur" value="<?php echo $adresse_fournissseur; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email Fournisseur <?php echo form_error('email_fournisseur') ?></label>
            <input type="text" class="form-control" name="email_fournisseur" id="email_fournisseur" placeholder="Email Fournisseur" value="<?php echo $email_fournisseur; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Date Creation Fournisseur <?php echo form_error('date_creation_fournisseur') ?></label>
            <input type="text" class="form-control" name="date_creation_fournisseur" id="date_creation_fournisseur" placeholder="Date Creation Fournisseur" value="<?php echo $date_creation_fournisseur; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Etat Fournisseur <?php echo form_error('etat_fournisseur') ?></label>
            <input type="text" class="form-control" name="etat_fournisseur" id="etat_fournisseur" placeholder="Etat Fournisseur" value="<?php echo $etat_fournisseur; ?>" />
        </div>
	    <input type="hidden" name="id_fournisseur" value="<?php echo $id_fournisseur; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('fournisseur') ?>" class="btn btn-default">Cancel</a>
	</form>

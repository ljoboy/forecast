        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nom <?php echo form_error('nom') ?></label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo $nom; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Postnom <?php echo form_error('postnom') ?></label>
            <input type="text" class="form-control" name="postnom" id="postnom" placeholder="Postnom" value="<?php echo $postnom; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Prenom <?php echo form_error('prenom') ?></label>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo $prenom; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Etat Civil <?php echo form_error('etat_civil') ?></label>
            <input type="text" class="form-control" name="etat_civil" id="etat_civil" placeholder="Etat Civil" value="<?php echo $etat_civil; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Matricule <?php echo form_error('matricule') ?></label>
            <input type="text" class="form-control" name="matricule" id="matricule" placeholder="Matricule" value="<?php echo $matricule; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Adresse <?php echo form_error('adresse') ?></label>
            <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="<?php echo $adresse; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Date De Naissance <?php echo form_error('date_de_naissance') ?></label>
            <input type="text" class="form-control" name="date_de_naissance" id="date_de_naissance" placeholder="Date De Naissance" value="<?php echo $date_de_naissance; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Lieu De Naissance <?php echo form_error('lieu_de_naissance') ?></label>
            <input type="text" class="form-control" name="lieu_de_naissance" id="lieu_de_naissance" placeholder="Lieu De Naissance" value="<?php echo $lieu_de_naissance; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Telephone <?php echo form_error('telephone') ?></label>
            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone" value="<?php echo $telephone; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Genre <?php echo form_error('genre') ?></label>
            <input type="text" class="form-control" name="genre" id="genre" placeholder="Genre" value="<?php echo $genre; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Date Entree <?php echo form_error('date_entree') ?></label>
            <input type="text" class="form-control" name="date_entree" id="date_entree" placeholder="Date Entree" value="<?php echo $date_entree; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Date Confirmation <?php echo form_error('date_confirmation') ?></label>
            <input type="text" class="form-control" name="date_confirmation" id="date_confirmation" placeholder="Date Confirmation" value="<?php echo $date_confirmation; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Date Fin <?php echo form_error('date_fin') ?></label>
            <input type="text" class="form-control" name="date_fin" id="date_fin" placeholder="Date Fin" value="<?php echo $date_fin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ville <?php echo form_error('ville') ?></label>
            <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?php echo $ville; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Province <?php echo form_error('province') ?></label>
            <input type="text" class="form-control" name="province" id="province" placeholder="Province" value="<?php echo $province; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pays <?php echo form_error('pays') ?></label>
            <input type="text" class="form-control" name="pays" id="pays" placeholder="Pays" value="<?php echo $pays; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Departement <?php echo form_error('departement_id_departement') ?></label>
            <select name=departement_id_departement"" id="departement_id_departement" class="form-control">
                <?php foreach ($departements as $departement) {
                    echo "<option value='$departement->id_departement'>$departement->nom_departement</option>";
                }?>
            </select>
        </div>
	    <input type="hidden" name="id_agent" value="<?php echo $id_agent; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('agent') ?>" class="btn btn-default">Cancel</a>
	</form>

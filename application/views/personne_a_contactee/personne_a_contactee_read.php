
        <h2 style="margin-top:0px">Personne_a_contactee Read</h2>
        <table class="table">
	    <tr><td>Nom Complet</td><td><?php echo $nom_complet; ?></td></tr>
	    <tr><td>Telephone</td><td><?php echo $telephone; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Relation</td><td><?php echo $relation; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('personne_a_contactee') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>


        <h2 style="margin-top:0px">Personne_a_contactee List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('personne_a_contactee/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('personne_a_contactee/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('personne_a_contactee'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nom Complet</th>
		<th>Telephone</th>
		<th>Email</th>
		<th>Relation</th>
		<th>Action</th>
            </tr><?php
            foreach ($personne_a_contactee_data as $personne_a_contactee)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $personne_a_contactee->nom_complet ?></td>
			<td><?php echo $personne_a_contactee->telephone ?></td>
			<td><?php echo $personne_a_contactee->email ?></td>
			<td><?php echo $personne_a_contactee->relation ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('personne_a_contactee/read/'.$personne_a_contactee->id_personne_a_contactee),'Read'); 
				echo ' | '; 
				echo anchor(site_url('personne_a_contactee/update/'.$personne_a_contactee->id_personne_a_contactee),'Update'); 
				echo ' | '; 
				echo anchor(site_url('personne_a_contactee/delete/'.$personne_a_contactee->id_personne_a_contactee),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('personne_a_contactee/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

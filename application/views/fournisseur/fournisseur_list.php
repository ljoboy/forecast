
        <h2 style="margin-top:0px">Fournisseur List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('fournisseur/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('fournisseur/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('fournisseur'); ?>" class="btn btn-default">Reset</a>
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
		<th>Reference Fornisseur</th>
		<th>Adresse Fournissseur</th>
		<th>Email Fournisseur</th>
		<th>Date Creation Fournisseur</th>
		<th>Etat Fournisseur</th>
		<th>Action</th>
            </tr><?php
            foreach ($fournisseur_data as $fournisseur)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $fournisseur->reference_fornisseur ?></td>
			<td><?php echo $fournisseur->adresse_fournissseur ?></td>
			<td><?php echo $fournisseur->email_fournisseur ?></td>
			<td><?php echo $fournisseur->date_creation_fournisseur ?></td>
			<td><?php echo $fournisseur->etat_fournisseur ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('fournisseur/read/'.$fournisseur->id_fournisseur),'Read'); 
				echo ' | '; 
				echo anchor(site_url('fournisseur/update/'.$fournisseur->id_fournisseur),'Update'); 
				echo ' | '; 
				echo anchor(site_url('fournisseur/delete/'.$fournisseur->id_fournisseur),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('fournisseur/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

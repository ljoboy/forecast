
        <h2 style="margin-top:0px">Entree List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('entree/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('entree/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('entree'); ?>" class="btn btn-default">Reset</a>
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
		<th>Quantite Entree</th>
		<th>Date Entree</th>
		<th>Date Enregistre</th>
		<th>Etat Entree</th>
		<th>Prix Unitaire</th>
		<th>Description Entree</th>
		<th>Materiel Code Materiel</th>
		<th>Action</th>
            </tr><?php
            foreach ($entree_data as $entree)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $entree->quantite_entree ?></td>
			<td><?php echo $entree->date_entree ?></td>
			<td><?php echo $entree->date_enregistre ?></td>
			<td><?php echo $entree->etat_entree ?></td>
			<td><?php echo $entree->prix_unitaire ?></td>
			<td><?php echo $entree->description_entree ?></td>
			<td><?php echo $entree->materiel_code_materiel ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('entree/read/'.$entree->id_entree),'Read'); 
				echo ' | '; 
				echo anchor(site_url('entree/update/'.$entree->id_entree),'Update'); 
				echo ' | '; 
				echo anchor(site_url('entree/delete/'.$entree->id_entree),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('entree/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

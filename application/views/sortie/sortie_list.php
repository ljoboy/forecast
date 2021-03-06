
        <h2 style="margin-top:0px">Sortie List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('sortie/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('sortie/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('sortie'); ?>" class="btn btn-default">Reset</a>
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
		<th>Date Sortie</th>
		<th>Date Enregistrer</th>
		<th>Qte Sortie</th>
		<th>Motif Sortie</th>
		<th>Materiel Code Materiel</th>
		<th>Action</th>
            </tr><?php
            foreach ($sortie_data as $sortie)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $sortie->date_sortie ?></td>
			<td><?php echo $sortie->date_enregistrer ?></td>
			<td><?php echo $sortie->qte_sortie ?></td>
			<td><?php echo $sortie->motif_sortie ?></td>
			<td><?php echo $sortie->materiel_code_materiel ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('sortie/read/'.$sortie->id_sortie),'Read'); 
				echo ' | '; 
				echo anchor(site_url('sortie/update/'.$sortie->id_sortie),'Update'); 
				echo ' | '; 
				echo anchor(site_url('sortie/delete/'.$sortie->id_sortie),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('sortie/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>


        <h2 style="margin-top:0px">Livraison List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('livraison/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('livraison/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('livraison'); ?>" class="btn btn-default">Reset</a>
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
		<th>Quantite Livree</th>
		<th>Date Livraison</th>
		<th>Date Creation</th>
		<th>Sortie Id Sortie</th>
		<th>Action</th>
            </tr><?php
            foreach ($livraison_data as $livraison)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $livraison->quantite_livree ?></td>
			<td><?php echo $livraison->date_livraison ?></td>
			<td><?php echo $livraison->date_creation ?></td>
			<td><?php echo $livraison->sortie_id_sortie ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('livraison/read/'.$livraison->id_livraison),'Read'); 
				echo ' | '; 
				echo anchor(site_url('livraison/update/'.$livraison->id_livraison),'Update'); 
				echo ' | '; 
				echo anchor(site_url('livraison/delete/'.$livraison->id_livraison),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('livraison/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

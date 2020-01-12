
        <h2 style="margin-top:0px">Details_demande List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('details_demande/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('details_demande/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('details_demande'); ?>" class="btn btn-default">Reset</a>
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
		<th>Quantite Demande</th>
		<th>Demande Num Demande</th>
		<th>Materiel Code Materiel</th>
		<th>Action</th>
            </tr><?php
            foreach ($details_demande_data as $details_demande)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $details_demande->quantite_demande ?></td>
			<td><?php echo $details_demande->demande_num_demande ?></td>
			<td><?php echo $details_demande->materiel_code_materiel ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('details_demande/read/'.$details_demande->id_details_demande),'Read'); 
				echo ' | '; 
				echo anchor(site_url('details_demande/update/'.$details_demande->id_details_demande),'Update'); 
				echo ' | '; 
				echo anchor(site_url('details_demande/delete/'.$details_demande->id_details_demande),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('details_demande/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

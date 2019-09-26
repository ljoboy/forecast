
        <h2 style="margin-top:0px">Tache List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('tache/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('tache/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tache'); ?>" class="btn btn-default">Reset</a>
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
		<th>Tache</th>
		<th>Date Debut</th>
		<th>Date Fin</th>
		<th>Date Assignement</th>
		<th>Etat</th>
		<th>Details</th>
		<th>Action</th>
            </tr><?php
            foreach ($tache_data as $tache)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $tache->tache ?></td>
			<td><?php echo $tache->date_debut ?></td>
			<td><?php echo $tache->date_fin ?></td>
			<td><?php echo $tache->date_assignement ?></td>
			<td><?php echo $tache->etat ?></td>
			<td><?php echo $tache->details ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tache/read/'.$tache->id_tache),'Read'); 
				echo ' | '; 
				echo anchor(site_url('tache/update/'.$tache->id_tache),'Update'); 
				echo ' | '; 
				echo anchor(site_url('tache/delete/'.$tache->id_tache),'Delete','onclick="javasciprt: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('tache/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

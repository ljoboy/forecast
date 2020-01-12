
        <h2 style="margin-top:0px">Conge List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('conge/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('conge/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('conge'); ?>" class="btn btn-default">Reset</a>
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
		<th>Type</th>
		<th>Date Debut</th>
		<th>Date Fin</th>
		<th>Details</th>
		<th>Agent Id Agent</th>
		<th>Action</th>
            </tr><?php
            foreach ($conge_data as $conge)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $conge->type ?></td>
			<td><?php echo $conge->date_debut ?></td>
			<td><?php echo $conge->date_fin ?></td>
			<td><?php echo $conge->details ?></td>
			<td><?php echo $conge->agent_id_agent ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('conge/read/'.$conge->id_conge),'Read'); 
				echo ' | '; 
				echo anchor(site_url('conge/update/'.$conge->id_conge),'Update'); 
				echo ' | '; 
				echo anchor(site_url('conge/delete/'.$conge->id_conge),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('conge/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

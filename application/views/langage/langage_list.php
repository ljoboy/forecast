
        <h2 style="margin-top:0px">Langage List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('langage/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('langage/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('langage'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nom Langage</th>
		<th>Description</th>
		<th>Connaissances Linguistiques Id Langue Parler</th>
		<th>Action</th>
            </tr><?php
            foreach ($langage_data as $langage)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $langage->nom_langage ?></td>
			<td><?php echo $langage->description ?></td>
			<td><?php echo $langage->connaissances_linguistiques_id_langue_parler ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('langage/read/'.$langage->id_langage),'Read'); 
				echo ' | '; 
				echo anchor(site_url('langage/update/'.$langage->id_langage),'Update'); 
				echo ' | '; 
				echo anchor(site_url('langage/delete/'.$langage->id_langage),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('langage/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

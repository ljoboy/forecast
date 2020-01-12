
        <h2 style="margin-top:0px">Connaissances_linguistiques List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('connaissances_linguistiques/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('connaissances_linguistiques/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('connaissances_linguistiques'); ?>" class="btn btn-default">Reset</a>
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
		<th>Lecture</th>
		<th>Ecriture</th>
		<th>Parler</th>
		<th>Comprendre</th>
		<th>Agent Id Agent</th>
		<th>Action</th>
            </tr><?php
            foreach ($connaissances_linguistiques_data as $connaissances_linguistiques)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $connaissances_linguistiques->lecture ?></td>
			<td><?php echo $connaissances_linguistiques->ecriture ?></td>
			<td><?php echo $connaissances_linguistiques->parler ?></td>
			<td><?php echo $connaissances_linguistiques->comprendre ?></td>
			<td><?php echo $connaissances_linguistiques->agent_id_agent ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('connaissances_linguistiques/read/'.$connaissances_linguistiques->id_langue_parler),'Read'); 
				echo ' | '; 
				echo anchor(site_url('connaissances_linguistiques/update/'.$connaissances_linguistiques->id_langue_parler),'Update'); 
				echo ' | '; 
				echo anchor(site_url('connaissances_linguistiques/delete/'.$connaissances_linguistiques->id_langue_parler),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('connaissances_linguistiques/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

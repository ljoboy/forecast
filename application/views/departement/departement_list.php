
        <div class="row">
            <div class="col-md-4">
                <?php echo anchor(site_url('departement/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped table-bordered"">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nom Departement</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($departement_data as $departement)
                {
                    ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $departement->nom_departement ?></td>
                        <td><?php echo $departement->description ?></td>
                        <td>
                            <?php
                            echo anchor(site_url('departement/update/'.$departement->id_departement),'<i class="fa fa-pencil"></i> Modifier');
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('departement/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

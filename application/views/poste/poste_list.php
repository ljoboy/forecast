
        <div class="row">
            <div class="col-md-4">
                <?php echo anchor(site_url('poste/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nom Poste</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($poste_data as $poste)
            {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $poste->nom_poste ?></td>
                    <td><?php echo $poste->description ?></td>
                    <td><?php echo $poste->type ?></td>
                    <td>
                        <?php
                        echo anchor(site_url('poste/read/'.$poste->id_poste),'Read');
                        echo ' | ';
                        echo anchor(site_url('poste/update/'.$poste->id_poste),'Update');
                        echo ' | ';
                        echo anchor(site_url('poste/delete/'.$poste->id_poste),'Delete','onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="col-md-6 text-right">
            <?php echo $pagination ?>
        </div>

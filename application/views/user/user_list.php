
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('user/create'),'<i class="fa fa-plus"></i> Créer', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Agent</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($user_data as $user)
            {
                $agent = $this->Agent_model->get_by_id($user->id_user);
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $user->username ?></td>
                    <td><?php echo $user->email ?></td>
                    <td><?php echo ($agent) ? strtoupper($agent->nom)." ".ucwords($agent->postnom." ".$agent->prenom)  : "---" ?></td>
                    <td>
                        <button type="button" onclick="desactiver(<?php echo $user->id_user.','.$user->etat;?>);" class="btn btn-sm btn-toggle <?=($user->etat == 1) ? 'active' : ''?>" data-toggle="button" aria-pressed="<?=($user->etat == 1) ? 'true' : 'false'?>">
                            <div class="handle"></div>
                        </button>
                    </td>
                    <td>
                        <?php
                        echo anchor(site_url('user/update/'.$user->id_user),'<i class="fa fa-pencil"></i> Modifier', 'class="btn btn-info btn-xs"');
                        echo anchor(site_url('user/delete/'.$user->id_user),'<i class="fa fa-trash"></i> Effacer','class="btn btn-danger btn-xs" onclick="Javascript: return confirm(\'Etes-vous sure ?\')"');
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
		<?php echo anchor(site_url('user/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
        </div>

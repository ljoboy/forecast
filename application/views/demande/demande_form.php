<?php echo form_open($action) ?>
<?php echo validation_errors()?>
    <div class="form-group">
        <label for="code_materiel">Materiel <?php echo form_error('code_materiel') ?></label>
        <select class="form-control" name="code_materiel" id="code_materiel">
            <?php
            foreach ($materiels as $materiel) {
                echo "<option value='$materiel->code_materiel'>$materiel->designation_materiel</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="agent">Agent <?php echo form_error('agent') ?></label>
        <select class="form-control" name="agent" id="agent">
            <?php
            foreach ($agents as $agent) {
                $identite = strtoupper($agent->nom." ".$agent->postnom)." ".ucfirst($agent->prenom);
                echo "<option value='$agent->id_agent'>$identite</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="int">Quantite Demande <?php echo form_error('quantite_demande') ?></label>
        <input min="1" type="number" class="form-control" name="quantite_demande" id="quantite_demande" placeholder="Quantite Demande" value="<?php echo $quantite_demande; ?>" />
    </div>
    <div class="form-group">
        <label for="int">Date debut <?php echo form_error('date_debut') ?></label>
        <input onchange="f(this.value)" min="<?php echo date('Y-m-d' )?>" type="date" class="form-control" name="date_debut" id="date_debut" value="<?php echo $date_debut; ?>" />
    </div>
    <div class="form-group">
        <label for="int">Date debut <?php echo form_error('date_fin') ?></label>
        <input min="<?php echo date('Y-m-d' )?>" type="date" class="form-control" name="date_fin" id="date_fin" value="<?php echo $date_fin; ?>" />
    </div>
    <script>
        var fin = document.getElementById('date_fin');
        function f(val) {
            fin.min = val;
        }
    </script>
    <div class="form-group">
        <label for="varchar">Motivation de la demande <?php echo form_error('description_demande') ?></label>
        <textarea class="form-control" name="description_demande" id="description_demande" placeholder="Description Demande"><?php echo $description_demande; ?></textarea>
    </div>
<input type="hidden" name="num_demande" value="<?php echo $num_demande; ?>" />
    <button type="submit" class="btn btn-primary">Ajouter</button>
    <a href="<?php echo site_url('demande') ?>" class="btn btn-default">Annuler</a>
<?php echo form_close() ?>

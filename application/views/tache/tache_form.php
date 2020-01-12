<?php echo form_open($action) ?>
    <div class="form-group">
        <label for="tache">
            Titre de la tache <?php echo form_error('tache') ?><span class="text-danger">*</span>
        </label>
        <input placeholder="Titre de la tache" type="text" id="tache" name="tache" required="required"
                   class="form-control" value="<?php echo $tache; ?>">
    </div>
    <div class="form-group">
        <label>
            Date début <?php echo form_error('date_debut') ?><span class="text-danger">*</span>
        </label>
        <input onchange="f(this.value)" id="date_debut" min="<?php echo date('Y-m-d') ?>" class="form-control" name="date_debut"
               type="date" value="<?php echo $date_debut; ?>">
    </div>
    <div class="form-group">
        <label>
            Date fin <?php echo form_error('date_fin') ?><span class="text-danger">*</span>
        </label>
        <input class="form-control" id="date_fin" name="date_fin" type="date" value="<?php echo$date_fin; ?>">
    </div>
    <script>
        var fin = document.getElementById('date_fin');
        function f(val) {
            fin.min = val;
        }
    </script>
    <div class="form-group">
        <label for="departement">Departement <?php echo form_error('departement') ?></label>
            <select class="form-control" name="departement" id="departement">
                <?php
                foreach ($departements as $departement) :
                ?>
                <option value="<?php echo $departement->id_departement ?>"><?php echo ucfirst($departement->nom_departement) ?></option>
                <?php
                endforeach;
                ?>
            </select>
    </div>
    <div class="form-group">
        <label for="details">Details <?php echo form_error('details') ?></label>
            <textarea id="details" name="details" class="form-control" rows="3" placeholder='Details de la tâche'><?php echo $details; ?></textarea>
    </div>
    <input type="hidden" name="id_tache" value="<?php echo $id_tache; ?>"/>
    <button type="submit" class="btn btn-primary">Ajouter</button>
    <a href="<?php echo site_url('tache') ?>" class="btn btn-default">Annuler</a>
<?php echo form_close() ?>

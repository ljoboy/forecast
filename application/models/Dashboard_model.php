<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_nbAgent()
    {
        return $this->db->count_all_results('agent');
    }

    public function get_nbHommes()
    {
        $this->db->where('genre', 'm');
        $this->db->from('agent');
        return $this->db->count_all_results();
    }

    public function get_nbFemmes()
    {
        $this->db->where('genre', 'f');
        $this->db->from('agent');
        return $this->db->count_all_results();
    }

    public function get_nbTaches()
    {
        return $this->db->count_all_results('tache');
    }

    public function get_nbDepartements()
    {
        return $this->db->count_all_results('departement');
    }

    public function get_avgTask()
    {
        $this->db->group_by('departement_id_departement');
        return $this->db->count_all_results('tache');
    }

    public function get_depTask()
    {
        $q = $this->db->query('SELECT COUNT(t.tache) as nbTache, d.nom_departement FROM tache t, departement d WHERE t.departement_id_departement = d.id_departement GROUP BY t.departement_id_departement ORDER BY nbTache');
        return $q->result();
    }

    public function get_depEndTask()
    {
        $q = $this->db->query('SELECT COUNT(t.tache) as nbTache, d.nom_departement FROM tache t, departement d WHERE t.departement_id_departement = d.id_departement AND t.etat = 1 GROUP BY t.departement_id_departement ORDER BY nbTache');
        return $q->result();
    }

    public function get_departements()
    {
        return $this->db->get('departement')->result();
    }

    public function get_materiels()
    {
        return $this->db->get('materiel')->result();
    }

    public function get_besoins()
    {
        return $this->db->get('besoin')->result();
    }

    public function get_demandes()
    {
        return $this->db->get('demande')->result();
    }

    public function get_nbSorties()
    {
        $q = $this->db->query('SELECT SUM(qte_sortie) as nb FROM sortie');
        return $q->row();
    }

    public function get_somMat()
    {
        $q = $this->db->query('SELECT SUM(quantite_stock) as nb FROM materiel');
        return $q->row();
    }

    public function get_topArtDmd()
    {
        $q = $this->db->query('SELECT COUNT(d.quantite_demande) as qte, m.designation_materiel FROM demande d, materiel m WHERE d.code_materiel = m.code_materiel GROUP BY m.designation_materiel ORDER BY qte DESC LIMIT 5');
        return $q->result();
    }

    public function sum_besoins()
    {
        $q = $this->db->query('SELECT SUM(prix_unitaire_besoin * quantite_besoin) as qte FROM besoin');
        return $q->row();
    }
}

/* End of file .php */

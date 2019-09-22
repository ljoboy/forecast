<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agent_model extends CI_Model
{

    public $table = 'agent';
    public $id = 'id_agent';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_agent', $q);
        $this->db->or_like('nom', $q);
        $this->db->or_like('postnom', $q);
        $this->db->or_like('prenom', $q);
        $this->db->or_like('etat_civil', $q);
        $this->db->or_like('matricule', $q);
        $this->db->or_like('adresse', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('date_de_naissance', $q);
        $this->db->or_like('lieu_de_naissance', $q);
        $this->db->or_like('telephone', $q);
        $this->db->or_like('genre', $q);
        $this->db->or_like('date_entree', $q);
        $this->db->or_like('date_confirmation', $q);
        $this->db->or_like('date_fin', $q);
        $this->db->or_like('ville', $q);
        $this->db->or_like('province', $q);
        $this->db->or_like('pays', $q);
        $this->db->or_like('departement_id_departement', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_agent', $q);
        $this->db->or_like('nom', $q);
        $this->db->or_like('postnom', $q);
        $this->db->or_like('prenom', $q);
        $this->db->or_like('etat_civil', $q);
        $this->db->or_like('matricule', $q);
        $this->db->or_like('adresse', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('date_de_naissance', $q);
        $this->db->or_like('lieu_de_naissance', $q);
        $this->db->or_like('telephone', $q);
        $this->db->or_like('genre', $q);
        $this->db->or_like('date_entree', $q);
        $this->db->or_like('date_confirmation', $q);
        $this->db->or_like('date_fin', $q);
        $this->db->or_like('ville', $q);
        $this->db->or_like('province', $q);
        $this->db->or_like('pays', $q);
        $this->db->or_like('departement_id_departement', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->set('etat', 0);
        $this->db->where($this->id, $id);
        $this->db->update($this->table);
    }

}

/* End of file Agent_model.php */
/* Location: ./application/models/Agent_model.php */

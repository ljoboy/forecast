<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entree_model extends CI_Model
{

    public $table = 'entree';
    public $id = 'id_entree';
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
        $this->db->like('id_entree', $q);
	$this->db->or_like('quantite_entree', $q);
	$this->db->or_like('date_entree', $q);
	$this->db->or_like('date_enregistre', $q);
	$this->db->or_like('etat_entree', $q);
	$this->db->or_like('prix_unitaire', $q);
	$this->db->or_like('description_entree', $q);
	$this->db->or_like('materiel_code_materiel', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_entree', $q);
	$this->db->or_like('quantite_entree', $q);
	$this->db->or_like('date_entree', $q);
	$this->db->or_like('date_enregistre', $q);
	$this->db->or_like('etat_entree', $q);
	$this->db->or_like('prix_unitaire', $q);
	$this->db->or_like('description_entree', $q);
	$this->db->or_like('materiel_code_materiel', $q);
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

/* End of file Entree_model.php */
/* Location: ./application/models/Entree_model.php */

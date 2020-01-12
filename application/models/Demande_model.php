<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Demande_model extends CI_Model
{

    public $table = 'demande';
    public $id = 'num_demande';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('etat_demande', 1);
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
        $this->db->like('num_demande', $q);
	$this->db->or_like('date_creation_demande', $q);
	$this->db->or_like('description_demande', $q);
	$this->db->or_like('code_materiel', $q);
	$this->db->or_like('quantite_demande', $q);
	$this->db->or_like('etat_demande', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('num_demande', $q);
	$this->db->or_like('date_creation_demande', $q);
	$this->db->or_like('description_demande', $q);
	$this->db->or_like('code_materiel', $q);
	$this->db->or_like('quantite_demande', $q);
	$this->db->or_like('etat_demande', $q);
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
        $this->db->set('etat_demande', 0);
        $this->db->where($this->id, $id);
        $this->db->update($this->table);
    }

    function accepted($id)
    {
        $this->db->set('etat_demande', 2);
        $this->db->where($this->id, $id);
        $this->db->update($this->table);
    }

    function get_accepted()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('etat_demande', 2);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Demande_model.php */
/* Location: ./application/models/Demande_model.php */

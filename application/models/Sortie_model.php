<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sortie_model extends CI_Model
{

    public $table = 'sortie';
    public $id = 'id_sortie';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->load->model('Materiel_model');
    }

    // get all
    function get_all()
    {
        $this->db->order_by('date_sortie', $this->order);
        return $this->db->get('materiel_sortie')->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_sortie', $q);
	$this->db->or_like('date_sortie', $q);
	$this->db->or_like('date_enregistrer', $q);
	$this->db->or_like('qte_sortie', $q);
	$this->db->or_like('motif_sortie', $q);
	$this->db->or_like('materiel_code_materiel', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_sortie', $q);
	$this->db->or_like('date_sortie', $q);
	$this->db->or_like('date_enregistrer', $q);
	$this->db->or_like('qte_sortie', $q);
	$this->db->or_like('motif_sortie', $q);
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

/* End of file Sortie_model.php */
/* Location: ./application/models/Sortie_model.php */

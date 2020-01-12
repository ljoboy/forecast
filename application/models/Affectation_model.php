<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Affectation_model extends CI_Model
{

    public $table = 'affectation';
    public $id = 'id_affectation';
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
        $this->db->like('id_affectation', $q);
	$this->db->or_like('date_affectation', $q);
	$this->db->or_like('is_actif', $q);
	$this->db->or_like('agent_id_agent', $q);
	$this->db->or_like('poste_id_poste', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_affectation', $q);
	$this->db->or_like('date_affectation', $q);
	$this->db->or_like('is_actif', $q);
	$this->db->or_like('agent_id_agent', $q);
	$this->db->or_like('poste_id_poste', $q);
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

    public function get_by_user_id($id)
    {
        $this->db->where('agent_id_agent', $id);
        $this->db->where('is_actif', 1);
        return $this->db->get($this->table)->row();
    }

}

/* End of file Affectation_model.php */
/* Location: ./application/models/Affectation_model.php */

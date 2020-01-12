<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Connaissances_linguistiques_model extends CI_Model
{

    public $table = 'connaissances_linguistiques';
    public $id = 'id_langue_parler';
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
        $this->db->like('id_langue_parler', $q);
	$this->db->or_like('lecture', $q);
	$this->db->or_like('ecriture', $q);
	$this->db->or_like('parler', $q);
	$this->db->or_like('comprendre', $q);
	$this->db->or_like('agent_id_agent', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_langue_parler', $q);
	$this->db->or_like('lecture', $q);
	$this->db->or_like('ecriture', $q);
	$this->db->or_like('parler', $q);
	$this->db->or_like('comprendre', $q);
	$this->db->or_like('agent_id_agent', $q);
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

    public function get_by_user($id)
    {
        $this->db->where('id_agent', $id);
        return $this->db->get('langue_agent')->result();
    }

}

/* End of file Connaissances_linguistiques_model.php */
/* Location: ./application/models/Connaissances_linguistiques_model.php */

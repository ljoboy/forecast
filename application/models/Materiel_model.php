<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materiel_model extends CI_Model
{

    public $table = 'materiel';
    public $id = 'code_materiel';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->where('etat_materiel', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where('etat_materiel', 1);
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->where('etat_materiel', 1);
        $this->db->like('code_materiel', $q);
	$this->db->or_like('designation_materiel', $q);
	$this->db->or_like('quantite_stock', $q);
	$this->db->or_like('stock_min', $q);
	$this->db->or_like('details', $q);
	$this->db->or_like('etat_materiel_materiel', $q);
	$this->db->or_like('fournisseur_id_fournisseur', $q);
	$this->db->or_like('categorie_materiel_id_cat_mat', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->where('etat_materiel', 1);
        $this->db->order_by($this->id, $this->order);
        $this->db->like('code_materiel', $q);
	$this->db->or_like('designation_materiel', $q);
	$this->db->or_like('quantite_stock', $q);
	$this->db->or_like('stock_min', $q);
	$this->db->or_like('details', $q);
	$this->db->or_like('etat_materiel_materiel', $q);
	$this->db->or_like('fournisseur_id_fournisseur', $q);
	$this->db->or_like('categorie_materiel_id_cat_mat', $q);
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
        $this->db->set('etat_materiel', 0);
        $this->db->where($this->id, $id);
        $this->db->update($this->table);
    }

    function get_rupture()
    {
        $this->db->where('etat_materiel', 1);
        $this->db->where('stock_min >= quantite_stock');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Materiel_model.php */
/* Location: ./application/models/Materiel_model.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_poste_model extends CI_Model
{
    public $table = 'user_poste';

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $this->db->where('agent_id_agent', $id);
        return $this->db->get($this->table)->row();
    }
}

/* End of file .php */

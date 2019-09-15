<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->is_connected)) redirect('auth/index', 'refresh');
    }

    public function index()
	{
	    $data =  array();
        $this->load->view('layouts/main.php', $data, FALSE);
	}

    public function grh()
    {
        $data = array();
        $this->load->view('layouts/main.php', $data, FALSE);
	}

    public function gst()
    {
        $data = array();
        $this->load->view('layouts/main.php', $data, FALSE);
	}

}


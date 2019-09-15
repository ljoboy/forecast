<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

	public function index()
	{
	    $data = array();
        $this->load->view('errors/custom/404', $data, FALSE);
	}

}


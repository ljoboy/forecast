<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->is_connected)) redirect('auth/index', 'refresh');
        $this->load->model('Dashboard_model');
    }

    public function index()
	{
	    if ($this->session->level == GST_LEVEL)
            $this->gst();
	    else
	        $this->grh();
	}

    public function grh()
    {
        $data = array(
            'nbAgent' => $this->Dashboard_model->get_nbAgent(),
            'nbHommes' => $this->Dashboard_model->get_nbHommes(),
            'nbFemmes' => $this->Dashboard_model->get_nbFemmes(),
            'nbTaches' => $this->Dashboard_model->get_nbTaches(),
            'nbDepartements' => $this->Dashboard_model->get_nbDepartements(),
            'depTasks' => $this->Dashboard_model->get_depTask(),
            'endDepTasks' => $this->Dashboard_model->get_depEndTask(),
            'departements' => $this->Dashboard_model->get_departements()
        );
        $data['nbTacheMoyen'] = $data['nbTaches'] / $data['nbDepartements'];
        $this->load->view('layouts/grh.php', $data, FALSE);
	}

    public function gst()
    {
        $data = array(
            "sum" => $this->Dashboard_model->get_somMat(),
            'materiels' => $this->Dashboard_model->get_materiels(),
            'besoins' => $this->Dashboard_model->get_besoins(),
            'demandes' => $this->Dashboard_model->get_demandes(),
            "nbSorties" => $this->Dashboard_model->get_nbSorties(),
            'topArtDmds' => $this->Dashboard_model->get_topArtDmd(),
            'sum_besoins' => $this->Dashboard_model->sum_besoins(),
        );
//        var_dump($data['nbSorties']);die();
        $this->load->view('layouts/gst.php', $data, FALSE);
	}

}


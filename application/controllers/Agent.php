<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agent extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Agent_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'agent/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'agent/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'agent/index.html';
            $config['first_url'] = base_url() . 'agent/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Agent_model->total_rows($q);
        $agent = $this->Agent_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'agent_data' => $agent,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('agent/agent_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Agent_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_agent' => $row->id_agent,
		'nom' => $row->nom,
		'postnom' => $row->postnom,
		'prenom' => $row->prenom,
		'etat_civil' => $row->etat_civil,
		'matricule' => $row->matricule,
		'adresse' => $row->adresse,
		'email' => $row->email,
		'date_de_naissance' => $row->date_de_naissance,
		'lieu_de_naissance' => $row->lieu_de_naissance,
		'telephone' => $row->telephone,
		'genre' => $row->genre,
		'date_entree' => $row->date_entree,
		'date_confirmation' => $row->date_confirmation,
		'date_fin' => $row->date_fin,
		'ville' => $row->ville,
		'province' => $row->province,
		'pays' => $row->pays,
		'departement_id_departement' => $row->departement_id_departement,
	    );
            $data['page'] = $this->load->view('agent/agent_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agent'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('agent/create_action'),
	    'id_agent' => set_value('id_agent'),
	    'nom' => set_value('nom'),
	    'postnom' => set_value('postnom'),
	    'prenom' => set_value('prenom'),
	    'etat_civil' => set_value('etat_civil'),
	    'matricule' => set_value('matricule'),
	    'adresse' => set_value('adresse'),
	    'email' => set_value('email'),
	    'date_de_naissance' => set_value('date_de_naissance'),
	    'lieu_de_naissance' => set_value('lieu_de_naissance'),
	    'telephone' => set_value('telephone'),
	    'genre' => set_value('genre'),
	    'date_entree' => set_value('date_entree'),
	    'date_confirmation' => set_value('date_confirmation'),
	    'date_fin' => set_value('date_fin'),
	    'ville' => set_value('ville'),
	    'province' => set_value('province'),
	    'pays' => set_value('pays'),
	    'departement_id_departement' => set_value('departement_id_departement'),
	);
        $this->load->view('agent/agent_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nom' => $this->input->post('nom',TRUE),
		'postnom' => $this->input->post('postnom',TRUE),
		'prenom' => $this->input->post('prenom',TRUE),
		'etat_civil' => $this->input->post('etat_civil',TRUE),
		'matricule' => $this->input->post('matricule',TRUE),
		'adresse' => $this->input->post('adresse',TRUE),
		'email' => $this->input->post('email',TRUE),
		'date_de_naissance' => $this->input->post('date_de_naissance',TRUE),
		'lieu_de_naissance' => $this->input->post('lieu_de_naissance',TRUE),
		'telephone' => $this->input->post('telephone',TRUE),
		'genre' => $this->input->post('genre',TRUE),
		'date_entree' => $this->input->post('date_entree',TRUE),
		'date_confirmation' => $this->input->post('date_confirmation',TRUE),
		'date_fin' => $this->input->post('date_fin',TRUE),
		'ville' => $this->input->post('ville',TRUE),
		'province' => $this->input->post('province',TRUE),
		'pays' => $this->input->post('pays',TRUE),
		'departement_id_departement' => $this->input->post('departement_id_departement',TRUE),
	    );

            $this->Agent_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('agent'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Agent_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('agent/update_action'),
		'id_agent' => set_value('id_agent', $row->id_agent),
		'nom' => set_value('nom', $row->nom),
		'postnom' => set_value('postnom', $row->postnom),
		'prenom' => set_value('prenom', $row->prenom),
		'etat_civil' => set_value('etat_civil', $row->etat_civil),
		'matricule' => set_value('matricule', $row->matricule),
		'adresse' => set_value('adresse', $row->adresse),
		'email' => set_value('email', $row->email),
		'date_de_naissance' => set_value('date_de_naissance', $row->date_de_naissance),
		'lieu_de_naissance' => set_value('lieu_de_naissance', $row->lieu_de_naissance),
		'telephone' => set_value('telephone', $row->telephone),
		'genre' => set_value('genre', $row->genre),
		'date_entree' => set_value('date_entree', $row->date_entree),
		'date_confirmation' => set_value('date_confirmation', $row->date_confirmation),
		'date_fin' => set_value('date_fin', $row->date_fin),
		'ville' => set_value('ville', $row->ville),
		'province' => set_value('province', $row->province),
		'pays' => set_value('pays', $row->pays),
		'departement_id_departement' => set_value('departement_id_departement', $row->departement_id_departement),
	    );
            $this->load->view('agent/agent_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agent'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_agent', TRUE));
        } else {
            $data = array(
		'nom' => $this->input->post('nom',TRUE),
		'postnom' => $this->input->post('postnom',TRUE),
		'prenom' => $this->input->post('prenom',TRUE),
		'etat_civil' => $this->input->post('etat_civil',TRUE),
		'matricule' => $this->input->post('matricule',TRUE),
		'adresse' => $this->input->post('adresse',TRUE),
		'email' => $this->input->post('email',TRUE),
		'date_de_naissance' => $this->input->post('date_de_naissance',TRUE),
		'lieu_de_naissance' => $this->input->post('lieu_de_naissance',TRUE),
		'telephone' => $this->input->post('telephone',TRUE),
		'genre' => $this->input->post('genre',TRUE),
		'date_entree' => $this->input->post('date_entree',TRUE),
		'date_confirmation' => $this->input->post('date_confirmation',TRUE),
		'date_fin' => $this->input->post('date_fin',TRUE),
		'ville' => $this->input->post('ville',TRUE),
		'province' => $this->input->post('province',TRUE),
		'pays' => $this->input->post('pays',TRUE),
		'departement_id_departement' => $this->input->post('departement_id_departement',TRUE),
	    );

            $this->Agent_model->update($this->input->post('id_agent', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('agent'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Agent_model->get_by_id($id);

        if ($row) {
            $this->Agent_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('agent'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agent'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nom', 'nom', 'trim|required');
	$this->form_validation->set_rules('postnom', 'postnom', 'trim|required');
	$this->form_validation->set_rules('prenom', 'prenom', 'trim|required');
	$this->form_validation->set_rules('etat_civil', 'etat civil', 'trim|required');
	$this->form_validation->set_rules('matricule', 'matricule', 'trim|required');
	$this->form_validation->set_rules('adresse', 'adresse', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('date_de_naissance', 'date de naissance', 'trim|required');
	$this->form_validation->set_rules('lieu_de_naissance', 'lieu de naissance', 'trim|required');
	$this->form_validation->set_rules('telephone', 'telephone', 'trim|required|numeric');
	$this->form_validation->set_rules('genre', 'genre', 'trim|required');
	$this->form_validation->set_rules('date_entree', 'date entree', 'trim|required');
	$this->form_validation->set_rules('date_confirmation', 'date confirmation', 'trim|required');
	$this->form_validation->set_rules('date_fin', 'date fin', 'trim|required');
	$this->form_validation->set_rules('ville', 'ville', 'trim|required');
	$this->form_validation->set_rules('province', 'province', 'trim|required');
	$this->form_validation->set_rules('pays', 'pays', 'trim|required');
	$this->form_validation->set_rules('departement_id_departement', 'departement id departement', 'trim|required');

	$this->form_validation->set_rules('id_agent', 'id_agent', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "agent.xls";
        $judul = "agent";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nom");
	xlsWriteLabel($tablehead, $kolomhead++, "Postnom");
	xlsWriteLabel($tablehead, $kolomhead++, "Prenom");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat Civil");
	xlsWriteLabel($tablehead, $kolomhead++, "Matricule");
	xlsWriteLabel($tablehead, $kolomhead++, "Adresse");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Date De Naissance");
	xlsWriteLabel($tablehead, $kolomhead++, "Lieu De Naissance");
	xlsWriteLabel($tablehead, $kolomhead++, "Telephone");
	xlsWriteLabel($tablehead, $kolomhead++, "Genre");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Entree");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Confirmation");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Fin");
	xlsWriteLabel($tablehead, $kolomhead++, "Ville");
	xlsWriteLabel($tablehead, $kolomhead++, "Province");
	xlsWriteLabel($tablehead, $kolomhead++, "Pays");
	xlsWriteLabel($tablehead, $kolomhead++, "Departement Id Departement");

	foreach ($this->Agent_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nom);
	    xlsWriteLabel($tablebody, $kolombody++, $data->postnom);
	    xlsWriteLabel($tablebody, $kolombody++, $data->prenom);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etat_civil);
	    xlsWriteLabel($tablebody, $kolombody++, $data->matricule);
	    xlsWriteLabel($tablebody, $kolombody++, $data->adresse);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_de_naissance);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lieu_de_naissance);
	    xlsWriteNumber($tablebody, $kolombody++, $data->telephone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->genre);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_entree);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_confirmation);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_fin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ville);
	    xlsWriteLabel($tablebody, $kolombody++, $data->province);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pays);
	    xlsWriteNumber($tablebody, $kolombody++, $data->departement_id_departement);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Agent.php */
/* Location: ./application/controllers/Agent.php */

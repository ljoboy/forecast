<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Personne_a_contactee extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Personne_a_contactee_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'personne_a_contactee/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'personne_a_contactee/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'personne_a_contactee/index.html';
            $config['first_url'] = base_url() . 'personne_a_contactee/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Personne_a_contactee_model->total_rows($q);
        $personne_a_contactee = $this->Personne_a_contactee_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'personne_a_contactee_data' => $personne_a_contactee,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('personne_a_contactee/personne_a_contactee_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Personne_a_contactee_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_personne_a_contactee' => $row->id_personne_a_contactee,
		'nom_complet' => $row->nom_complet,
		'telephone' => $row->telephone,
		'email' => $row->email,
		'relation' => $row->relation,
		'agent_id_agent' => $row->agent_id_agent,
	    );
            $data['page'] = $this->load->view('personne_a_contactee/personne_a_contactee_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('personne_a_contactee'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('personne_a_contactee/create_action'),
	    'id_personne_a_contactee' => set_value('id_personne_a_contactee'),
	    'nom_complet' => set_value('nom_complet'),
	    'telephone' => set_value('telephone'),
	    'email' => set_value('email'),
	    'relation' => set_value('relation'),
	    'agent_id_agent' => set_value('agent_id_agent'),
	);
        $data['page'] = $this->load->view('personne_a_contactee/personne_a_contactee_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nom_complet' => $this->input->post('nom_complet',TRUE),
		'telephone' => $this->input->post('telephone',TRUE),
		'email' => $this->input->post('email',TRUE),
		'relation' => $this->input->post('relation',TRUE),
	    );

            $this->Personne_a_contactee_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('personne_a_contactee'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Personne_a_contactee_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('personne_a_contactee/update_action'),
		'id_personne_a_contactee' => set_value('id_personne_a_contactee', $row->id_personne_a_contactee),
		'nom_complet' => set_value('nom_complet', $row->nom_complet),
		'telephone' => set_value('telephone', $row->telephone),
		'email' => set_value('email', $row->email),
		'relation' => set_value('relation', $row->relation),
		'agent_id_agent' => set_value('agent_id_agent', $row->agent_id_agent),
	    );
            $data['page'] = $this->load->view('personne_a_contactee/personne_a_contactee_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('personne_a_contactee'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_personne_a_contactee', TRUE));
        } else {
            $data = array(
		'nom_complet' => $this->input->post('nom_complet',TRUE),
		'telephone' => $this->input->post('telephone',TRUE),
		'email' => $this->input->post('email',TRUE),
		'relation' => $this->input->post('relation',TRUE),
	    );

            $this->Personne_a_contactee_model->update($this->input->post('id_personne_a_contactee', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('personne_a_contactee'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Personne_a_contactee_model->get_by_id($id);

        if ($row) {
            $this->Personne_a_contactee_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('personne_a_contactee'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('personne_a_contactee'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nom_complet', 'nom complet', 'trim|required');
	$this->form_validation->set_rules('telephone', 'telephone', 'trim|required|numeric');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('relation', 'relation', 'trim|required');

	$this->form_validation->set_rules('id_personne_a_contactee', 'id_personne_a_contactee', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "personne_a_contactee.xls";
        $judul = "personne_a_contactee";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nom Complet");
	xlsWriteLabel($tablehead, $kolomhead++, "Telephone");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Relation");

	foreach ($this->Personne_a_contactee_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nom_complet);
	    xlsWriteNumber($tablebody, $kolombody++, $data->telephone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->relation);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Personne_a_contactee.php */
/* Location: ./application/controllers/Personne_a_contactee.php */

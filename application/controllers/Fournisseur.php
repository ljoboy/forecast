<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fournisseur extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Fournisseur_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'fournisseur/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'fournisseur/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'fournisseur/index.html';
            $config['first_url'] = base_url() . 'fournisseur/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Fournisseur_model->total_rows($q);
        $fournisseur = $this->Fournisseur_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'fournisseur_data' => $fournisseur,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('fournisseur/fournisseur_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Fournisseur_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_fournisseur' => $row->id_fournisseur,
		'reference_fornisseur' => $row->reference_fornisseur,
		'adresse_fournissseur' => $row->adresse_fournissseur,
		'email_fournisseur' => $row->email_fournisseur,
		'date_creation_fournisseur' => $row->date_creation_fournisseur,
		'etat_fournisseur' => $row->etat_fournisseur,
	    );
            $data['page'] = $this->load->view('fournisseur/fournisseur_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fournisseur'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('fournisseur/create_action'),
	    'id_fournisseur' => set_value('id_fournisseur'),
	    'reference_fornisseur' => set_value('reference_fornisseur'),
	    'adresse_fournissseur' => set_value('adresse_fournissseur'),
	    'email_fournisseur' => set_value('email_fournisseur'),
	    'date_creation_fournisseur' => set_value('date_creation_fournisseur'),
	    'etat_fournisseur' => set_value('etat_fournisseur'),
	);
        $data['page'] = $this->load->view('fournisseur/fournisseur_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'reference_fornisseur' => $this->input->post('reference_fornisseur',TRUE),
		'adresse_fournissseur' => $this->input->post('adresse_fournissseur',TRUE),
		'email_fournisseur' => $this->input->post('email_fournisseur',TRUE),
		'date_creation_fournisseur' => $this->input->post('date_creation_fournisseur',TRUE),
		'etat_fournisseur' => $this->input->post('etat_fournisseur',TRUE),
	    );

            $this->Fournisseur_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('fournisseur'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Fournisseur_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('fournisseur/update_action'),
		'id_fournisseur' => set_value('id_fournisseur', $row->id_fournisseur),
		'reference_fornisseur' => set_value('reference_fornisseur', $row->reference_fornisseur),
		'adresse_fournissseur' => set_value('adresse_fournissseur', $row->adresse_fournissseur),
		'email_fournisseur' => set_value('email_fournisseur', $row->email_fournisseur),
		'date_creation_fournisseur' => set_value('date_creation_fournisseur', $row->date_creation_fournisseur),
		'etat_fournisseur' => set_value('etat_fournisseur', $row->etat_fournisseur),
	    );
            $data['page'] = $this->load->view('fournisseur/fournisseur_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fournisseur'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_fournisseur', TRUE));
        } else {
            $data = array(
		'reference_fornisseur' => $this->input->post('reference_fornisseur',TRUE),
		'adresse_fournissseur' => $this->input->post('adresse_fournissseur',TRUE),
		'email_fournisseur' => $this->input->post('email_fournisseur',TRUE),
		'date_creation_fournisseur' => $this->input->post('date_creation_fournisseur',TRUE),
		'etat_fournisseur' => $this->input->post('etat_fournisseur',TRUE),
	    );

            $this->Fournisseur_model->update($this->input->post('id_fournisseur', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('fournisseur'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Fournisseur_model->get_by_id($id);

        if ($row) {
            $this->Fournisseur_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('fournisseur'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fournisseur'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('reference_fornisseur', 'reference fornisseur', 'trim|required');
	$this->form_validation->set_rules('adresse_fournissseur', 'adresse fournissseur', 'trim|required');
	$this->form_validation->set_rules('email_fournisseur', 'email fournisseur', 'trim|required');
	$this->form_validation->set_rules('date_creation_fournisseur', 'date creation fournisseur', 'trim|required');
	$this->form_validation->set_rules('etat_fournisseur', 'etat fournisseur', 'trim|required');

	$this->form_validation->set_rules('id_fournisseur', 'id_fournisseur', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "fournisseur.xls";
        $judul = "fournisseur";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Reference Fornisseur");
	xlsWriteLabel($tablehead, $kolomhead++, "Adresse Fournissseur");
	xlsWriteLabel($tablehead, $kolomhead++, "Email Fournisseur");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Creation Fournisseur");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat Fournisseur");

	foreach ($this->Fournisseur_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->reference_fornisseur);
	    xlsWriteLabel($tablebody, $kolombody++, $data->adresse_fournissseur);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email_fournisseur);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_creation_fournisseur);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etat_fournisseur);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Fournisseur.php */
/* Location: ./application/controllers/Fournisseur.php */

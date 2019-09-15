<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entree extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Entree_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'entree/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'entree/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'entree/index.html';
            $config['first_url'] = base_url() . 'entree/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Entree_model->total_rows($q);
        $entree = $this->Entree_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'entree_data' => $entree,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('entree/entree_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Entree_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_entree' => $row->id_entree,
		'quantite_entree' => $row->quantite_entree,
		'date_entree' => $row->date_entree,
		'date_enregistre' => $row->date_enregistre,
		'etat_entree' => $row->etat_entree,
		'prix_unitaire' => $row->prix_unitaire,
		'description_entree' => $row->description_entree,
		'materiel_code_materiel' => $row->materiel_code_materiel,
	    );
            $data['page'] = $this->load->view('entree/entree_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('entree'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('entree/create_action'),
	    'id_entree' => set_value('id_entree'),
	    'quantite_entree' => set_value('quantite_entree'),
	    'date_entree' => set_value('date_entree'),
	    'date_enregistre' => set_value('date_enregistre'),
	    'etat_entree' => set_value('etat_entree'),
	    'prix_unitaire' => set_value('prix_unitaire'),
	    'description_entree' => set_value('description_entree'),
	    'materiel_code_materiel' => set_value('materiel_code_materiel'),
	);
        $data['page'] = $this->load->view('entree/entree_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'quantite_entree' => $this->input->post('quantite_entree',TRUE),
		'date_entree' => $this->input->post('date_entree',TRUE),
		'date_enregistre' => $this->input->post('date_enregistre',TRUE),
		'etat_entree' => $this->input->post('etat_entree',TRUE),
		'prix_unitaire' => $this->input->post('prix_unitaire',TRUE),
		'description_entree' => $this->input->post('description_entree',TRUE),
		'materiel_code_materiel' => $this->input->post('materiel_code_materiel',TRUE),
	    );

            $this->Entree_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('entree'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Entree_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('entree/update_action'),
		'id_entree' => set_value('id_entree', $row->id_entree),
		'quantite_entree' => set_value('quantite_entree', $row->quantite_entree),
		'date_entree' => set_value('date_entree', $row->date_entree),
		'date_enregistre' => set_value('date_enregistre', $row->date_enregistre),
		'etat_entree' => set_value('etat_entree', $row->etat_entree),
		'prix_unitaire' => set_value('prix_unitaire', $row->prix_unitaire),
		'description_entree' => set_value('description_entree', $row->description_entree),
		'materiel_code_materiel' => set_value('materiel_code_materiel', $row->materiel_code_materiel),
	    );
            $data['page'] = $this->load->view('entree/entree_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('entree'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_entree', TRUE));
        } else {
            $data = array(
		'quantite_entree' => $this->input->post('quantite_entree',TRUE),
		'date_entree' => $this->input->post('date_entree',TRUE),
		'date_enregistre' => $this->input->post('date_enregistre',TRUE),
		'etat_entree' => $this->input->post('etat_entree',TRUE),
		'prix_unitaire' => $this->input->post('prix_unitaire',TRUE),
		'description_entree' => $this->input->post('description_entree',TRUE),
		'materiel_code_materiel' => $this->input->post('materiel_code_materiel',TRUE),
	    );

            $this->Entree_model->update($this->input->post('id_entree', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('entree'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Entree_model->get_by_id($id);

        if ($row) {
            $this->Entree_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('entree'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('entree'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('quantite_entree', 'quantite entree', 'trim|required');
	$this->form_validation->set_rules('date_entree', 'date entree', 'trim|required');
	$this->form_validation->set_rules('date_enregistre', 'date enregistre', 'trim|required');
	$this->form_validation->set_rules('etat_entree', 'etat entree', 'trim|required');
	$this->form_validation->set_rules('prix_unitaire', 'prix unitaire', 'trim|required');
	$this->form_validation->set_rules('description_entree', 'description entree', 'trim|required');
	$this->form_validation->set_rules('materiel_code_materiel', 'materiel code materiel', 'trim|required');

	$this->form_validation->set_rules('id_entree', 'id_entree', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "entree.xls";
        $judul = "entree";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Quantite Entree");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Entree");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Enregistre");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat Entree");
	xlsWriteLabel($tablehead, $kolomhead++, "Prix Unitaire");
	xlsWriteLabel($tablehead, $kolomhead++, "Description Entree");
	xlsWriteLabel($tablehead, $kolomhead++, "Materiel Code Materiel");

	foreach ($this->Entree_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->quantite_entree);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_entree);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_enregistre);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etat_entree);
	    xlsWriteLabel($tablebody, $kolombody++, $data->prix_unitaire);
	    xlsWriteLabel($tablebody, $kolombody++, $data->description_entree);
	    xlsWriteNumber($tablebody, $kolombody++, $data->materiel_code_materiel);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Entree.php */
/* Location: ./application/controllers/Entree.php */

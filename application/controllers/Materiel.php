<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materiel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Demande_model');
        $this->load->model('Materiel_model');
        $this->load->model('Categorie_materiel_model');
        $this->load->model('Fournisseur_model');
        $this->load->model('Agent_model');

        $this->load->library('form_validation');
    }

    public function index()
    {

        $data = array(
            'materiel_data' => $this->Materiel_model->get_all(),
            'categories' => $this->Categorie_materiel_model->get_all(),
            'fournisseurs' => $this->Fournisseur_model->get_all(),
        );

        $data['page'] = $this->load->view('materiel/materiel_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Materiel_model->get_by_id($id);
        if ($row) {
            $data = array(
                'code_materiel' => $row->code_materiel,
                'designation_materiel' => $row->designation_materiel,
                'quantite_stock' => $row->quantite_stock,
                'stock_min' => $row->stock_min,
                'details' => $row->details,
                'etat_materiel' => $row->etat_materiel,
                'fournisseur_id_fournisseur' => $row->fournisseur_id_fournisseur,
                'categorie_materiel_id_cat_mat' => $row->categorie_materiel_id_cat_mat,
            );
            $data['page'] = $this->load->view('materiel/materiel_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('materiel'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('materiel/create_action'),
	    'code_materiel' => set_value('code_materiel'),
	    'designation_materiel' => set_value('designation_materiel'),
	    'quantite_stock' => set_value('quantite_stock'),
	    'stock_min' => set_value('stock_min'),
	    'details' => set_value('details'),
	    'etat_materiel' => set_value('etat_materiel'),
	    'fournisseur_id_fournisseur' => set_value('fournisseur_id_fournisseur'),
	    'categorie_materiel_id_cat_mat' => set_value('categorie_materiel_id_cat_mat'),
	);
        $data['page'] = $this->load->view('materiel/materiel_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'designation_materiel' => $this->input->post('designation_materiel',TRUE),
		'quantite_stock' => $this->input->post('quantite_stock',TRUE),
		'stock_min' => $this->input->post('stock_min',TRUE),
		'details' => $this->input->post('details',TRUE),
		'etat_materiel' => $this->input->post('etat_materiel',TRUE),
		'fournisseur_id_fournisseur' => $this->input->post('fournisseur_id_fournisseur',TRUE),
		'categorie_materiel_id_cat_mat' => $this->input->post('categorie_materiel_id_cat_mat',TRUE),
	    );

            $this->Materiel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('materiel'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Materiel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('materiel/update_action'),
		'code_materiel' => set_value('code_materiel', $row->code_materiel),
		'designation_materiel' => set_value('designation_materiel', $row->designation_materiel),
		'quantite_stock' => set_value('quantite_stock', $row->quantite_stock),
		'stock_min' => set_value('stock_min', $row->stock_min),
		'details' => set_value('details', $row->details),
		'etat_materiel' => set_value('etat_materiel', $row->etat_materiel),
		'fournisseur_id_fournisseur' => set_value('fournisseur_id_fournisseur', $row->fournisseur_id_fournisseur),
		'categorie_materiel_id_cat_mat' => set_value('categorie_materiel_id_cat_mat', $row->categorie_materiel_id_cat_mat),
	    );
            $data['page'] = $this->load->view('materiel/materiel_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('materiel'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('code_materiel', TRUE));
        } else {
            $data = array(
		'designation_materiel' => $this->input->post('designation_materiel',TRUE),
		'quantite_stock' => $this->input->post('quantite_stock',TRUE),
		'stock_min' => $this->input->post('stock_min',TRUE),
		'details' => $this->input->post('details',TRUE),
		'etat_materiel' => $this->input->post('etat_materiel',TRUE),
		'fournisseur_id_fournisseur' => $this->input->post('fournisseur_id_fournisseur',TRUE),
		'categorie_materiel_id_cat_mat' => $this->input->post('categorie_materiel_id_cat_mat',TRUE),
	    );

            $this->Materiel_model->update($this->input->post('code_materiel', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('materiel'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Materiel_model->get_by_id($id);

        if ($row) {
            $this->Materiel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('materiel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('materiel'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('designation_materiel', 'designation materiel', 'trim|required');
	$this->form_validation->set_rules('quantite_stock', 'quantite stock', 'trim|required');
	$this->form_validation->set_rules('stock_min', 'stock min', 'trim|required');
	$this->form_validation->set_rules('details', 'details', 'trim|required');
	$this->form_validation->set_rules('etat_materiel', 'etat materiel', 'trim|required');
	$this->form_validation->set_rules('fournisseur_id_fournisseur', 'fournisseur id fournisseur', 'trim|required');
	$this->form_validation->set_rules('categorie_materiel_id_cat_mat', 'categorie materiel id cat mat', 'trim|required');

	$this->form_validation->set_rules('code_materiel', 'code_materiel', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "materiel.xls";
        $judul = "materiel";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Designation Materiel");
	xlsWriteLabel($tablehead, $kolomhead++, "Quantite Stock");
	xlsWriteLabel($tablehead, $kolomhead++, "Stock Min");
	xlsWriteLabel($tablehead, $kolomhead++, "Details");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat Materiel");
	xlsWriteLabel($tablehead, $kolomhead++, "Fournisseur Id Fournisseur");
	xlsWriteLabel($tablehead, $kolomhead++, "Categorie Materiel Id Cat Mat");

	foreach ($this->Materiel_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->designation_materiel);
	    xlsWriteNumber($tablebody, $kolombody++, $data->quantite_stock);
	    xlsWriteNumber($tablebody, $kolombody++, $data->stock_min);
	    xlsWriteLabel($tablebody, $kolombody++, $data->details);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etat_materiel);
	    xlsWriteNumber($tablebody, $kolombody++, $data->fournisseur_id_fournisseur);
	    xlsWriteNumber($tablebody, $kolombody++, $data->categorie_materiel_id_cat_mat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function rupture()
    {
        $data = array(
            'materiel_data' => $this->Materiel_model->get_rupture(),
            'categories' => $this->Categorie_materiel_model->get_all(),
            'fournisseurs' => $this->Fournisseur_model->get_all(),
        );
        $data['page'] = $this->load->view('materiel/materiel_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function uses()
    {
        $data = array(
            'uses' => $this->Demande_model->get_accepted()
        );
        $data['page'] = $this->load->view('materiel/uses', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

}

/* End of file Materiel.php */
/* Location: ./application/controllers/Materiel.php */

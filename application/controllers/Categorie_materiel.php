<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorie_materiel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Categorie_materiel_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'categorie_materiel_data' => $this->Categorie_materiel_model->get_all(),
        );
        $data['page'] = $this->load->view('categorie_materiel/categorie_materiel_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Categorie_materiel_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_cat_mat' => $row->id_cat_mat,
		'nom_cat_mat' => $row->nom_cat_mat,
		'date_creation_cat' => $row->date_creation_cat,
		'details_cat_ma' => $row->details_cat_ma,
		'etat_cat_mat' => $row->etat_cat_mat,
	    );
            $data['page'] = $this->load->view('categorie_materiel/categorie_materiel_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categorie_materiel'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('categorie_materiel/create_action'),
	    'id_cat_mat' => set_value('id_cat_mat'),
	    'nom_cat_mat' => set_value('nom_cat_mat'),
	    'date_creation_cat' => set_value('date_creation_cat'),
	    'details_cat_ma' => set_value('details_cat_ma'),
	    'etat_cat_mat' => set_value('etat_cat_mat'),
	);
        $data['page'] = $this->load->view('categorie_materiel/categorie_materiel_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nom_cat_mat' => $this->input->post('nom_cat_mat',TRUE),
		'date_creation_cat' => $this->input->post('date_creation_cat',TRUE),
		'details_cat_ma' => $this->input->post('details_cat_ma',TRUE),
		'etat_cat_mat' => $this->input->post('etat_cat_mat',TRUE),
	    );

            $this->Categorie_materiel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('categorie_materiel'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Categorie_materiel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('categorie_materiel/update_action'),
		'id_cat_mat' => set_value('id_cat_mat', $row->id_cat_mat),
		'nom_cat_mat' => set_value('nom_cat_mat', $row->nom_cat_mat),
		'date_creation_cat' => set_value('date_creation_cat', $row->date_creation_cat),
		'details_cat_ma' => set_value('details_cat_ma', $row->details_cat_ma),
		'etat_cat_mat' => set_value('etat_cat_mat', $row->etat_cat_mat),
	    );
            $data['page'] = $this->load->view('categorie_materiel/categorie_materiel_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categorie_materiel'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_cat_mat', TRUE));
        } else {
            $data = array(
		'nom_cat_mat' => $this->input->post('nom_cat_mat',TRUE),
		'date_creation_cat' => $this->input->post('date_creation_cat',TRUE),
		'details_cat_ma' => $this->input->post('details_cat_ma',TRUE),
		'etat_cat_mat' => $this->input->post('etat_cat_mat',TRUE),
	    );

            $this->Categorie_materiel_model->update($this->input->post('id_cat_mat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categorie_materiel'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Categorie_materiel_model->get_by_id($id);

        if ($row) {
            $this->Categorie_materiel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categorie_materiel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categorie_materiel'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nom_cat_mat', 'nom cat mat', 'trim|required');
	$this->form_validation->set_rules('date_creation_cat', 'date creation cat', 'trim|required');
	$this->form_validation->set_rules('details_cat_ma', 'details cat ma', 'trim|required');
	$this->form_validation->set_rules('etat_cat_mat', 'etat cat mat', 'trim|required');

	$this->form_validation->set_rules('id_cat_mat', 'id_cat_mat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "categorie_materiel.xls";
        $judul = "categorie_materiel";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nom Cat Mat");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Creation Cat");
	xlsWriteLabel($tablehead, $kolomhead++, "Details Cat Ma");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat Cat Mat");

	foreach ($this->Categorie_materiel_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nom_cat_mat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_creation_cat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->details_cat_ma);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etat_cat_mat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Categorie_materiel.php */
/* Location: ./application/controllers/Categorie_materiel.php */

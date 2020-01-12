<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Besoin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Besoin_model');
        $this->load->library('form_validation');
    }

    public function index()
    {



        $data = array(
            'besoin_data' => $this->Besoin_model->get_all(),
            'start' => 0,
        );
        $data['page'] = $this->load->view('besoin/besoin_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Besoin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_besoin' => $row->id_besoin,
		'quantite_besoin' => $row->quantite_besoin,
		'nom_materiel' => $row->nom_materiel,
		'prix_unitaire_besoin' => $row->prix_unitaire_besoin,
		'details_besoin' => $row->details_besoin,
	    );
            $data['page'] = $this->load->view('besoin/besoin_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('besoin'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('besoin/create_action'),
            'id_besoin' => set_value('id_besoin'),
            'quantite_besoin' => set_value('quantite_besoin'),
            'nom_materiel' => set_value('nom_materiel'),
            'prix_unitaire_besoin' => set_value('prix_unitaire_besoin'),
            'details_besoin' => set_value('details_besoin'),
	    );
        $data['page'] =  $this->load->view('besoin/besoin_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'quantite_besoin' => $this->input->post('quantite_besoin',TRUE),
		'nom_materiel' => $this->input->post('nom_materiel',TRUE),
		'prix_unitaire_besoin' => $this->input->post('prix_unitaire_besoin',TRUE),
		'details_besoin' => $this->input->post('details_besoin',TRUE),
	    );

            $this->Besoin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('besoin'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Besoin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('besoin/update_action'),
		'id_besoin' => set_value('id_besoin', $row->id_besoin),
		'quantite_besoin' => set_value('quantite_besoin', $row->quantite_besoin),
		'nom_materiel' => set_value('nom_materiel', $row->nom_materiel),
		'prix_unitaire_besoin' => set_value('prix_unitaire_besoin', $row->prix_unitaire_besoin),
		'details_besoin' => set_value('details_besoin', $row->details_besoin),
	    );
            $data['page'] =  $this->load->view('besoin/besoin_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('besoin'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_besoin', TRUE));
        } else {
            $data = array(
		'quantite_besoin' => $this->input->post('quantite_besoin',TRUE),
		'nom_materiel' => $this->input->post('nom_materiel',TRUE),
		'prix_unitaire_besoin' => $this->input->post('prix_unitaire_besoin',TRUE),
		'details_besoin' => $this->input->post('details_besoin',TRUE),
	    );

            $this->Besoin_model->update($this->input->post('id_besoin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('besoin'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Besoin_model->get_by_id($id);

        if ($row) {
            $this->Besoin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('besoin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('besoin'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('quantite_besoin', 'quantite besoin', 'trim|required');
	$this->form_validation->set_rules('nom_materiel', 'nom materiel', 'trim|required');
	$this->form_validation->set_rules('prix_unitaire_besoin', 'prix unitaire besoin', 'trim|required|numeric');
	$this->form_validation->set_rules('details_besoin', 'details besoin', 'trim|required');

	$this->form_validation->set_rules('id_besoin', 'id_besoin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "besoin.xls";
        $judul = "besoin";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Quantite Besoin");
	xlsWriteLabel($tablehead, $kolomhead++, "Nom Materiel");
	xlsWriteLabel($tablehead, $kolomhead++, "Prix Unitaire Besoin");
	xlsWriteLabel($tablehead, $kolomhead++, "Details Besoin");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Creation Besoin");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat Besoin");

	foreach ($this->Besoin_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->quantite_besoin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nom_materiel);
	    xlsWriteNumber($tablebody, $kolombody++, $data->prix_unitaire_besoin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->details_besoin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_creation_besoin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etat_besoin);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Besoin.php */
/* Location: ./application/controllers/Besoin.php */

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Demande extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Demande_model');
        $this->load->model('Agent_model');
        $this->load->model('Materiel_model');
        $this->load->library('form_validation');
    }

    public function index()
    {


        $data = array(
            'demande_data' => $this->Demande_model->get_all(),
            'start' => 0,
        );
        $data['page'] = $this->load->view('demande/demande_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Demande_model->get_by_id($id);
        if ($row) {
            $data = array(
		'num_demande' => $row->num_demande,
		'date_creation_demande' => $row->date_creation_demande,
		'description_demande' => $row->description_demande,
		'code_materiel' => $row->code_materiel,
		'quantite_demande' => $row->quantite_demande,
		'etat_demande' => $row->etat_demande,
	    );
            $data['page'] = $this->load->view('demande/demande_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('demande'));
        }
    }

    public function create() 
    {
        $data = array(
            'action' => site_url('demande/create_action'),
            'num_demande' => set_value('num_demande'),
            'description_demande' => set_value('description_demande'),
            'code_materiel' => set_value('code_materiel'),
            'quantite_demande' => set_value('quantite_demande'),
            'date_debut' => set_value('date_debut'),
            'date_fin' => set_value('date_fin'),
            'agent' => set_value('agent'),
            'agents' => $this->Agent_model->get_all(),
            'materiels' => $this->Materiel_model->get_all(),
        );
        $data['page'] = $this->load->view('demande/demande_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'description_demande' => $this->input->post('description_demande', TRUE),
                'code_materiel' => $this->input->post('code_materiel', TRUE),
                'quantite_demande' => $this->input->post('quantite_demande', TRUE),
                'date_debut' => $this->input->post('date_debut', TRUE),
                'date_fin' => $this->input->post('date_fin', TRUE),
                'agent_id_agent' => $this->input->post('agent', TRUE),
            );

            $this->Demande_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('demande'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Demande_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('demande/update_action'),
		'num_demande' => set_value('num_demande', $row->num_demande),
		'date_creation_demande' => set_value('date_creation_demande', $row->date_creation_demande),
		'description_demande' => set_value('description_demande', $row->description_demande),
		'code_materiel' => set_value('code_materiel', $row->code_materiel),
		'quantite_demande' => set_value('quantite_demande', $row->quantite_demande),
		'etat_demande' => set_value('etat_demande', $row->etat_demande),
	    );
            $data['page'] = $this->load->view('demande/demande_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('demande'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('num_demande', TRUE));
        } else {
            $data = array(
		'date_creation_demande' => $this->input->post('date_creation_demande',TRUE),
		'description_demande' => $this->input->post('description_demande',TRUE),
		'code_materiel' => $this->input->post('code_materiel',TRUE),
		'quantite_demande' => $this->input->post('quantite_demande',TRUE),
		'etat_demande' => $this->input->post('etat_demande',TRUE),
	    );

            $this->Demande_model->update($this->input->post('num_demande', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('demande'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Demande_model->get_by_id($id);

        if ($row) {
            $this->Demande_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('demande'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('demande'));
        }
    }

    public function accepted($id)
    {
        $row = $this->Demande_model->get_by_id($id);

        if ($row) {
            $this->Demande_model->accepted($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('demande'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('demande'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('description_demande', 'description demande', 'trim|required');
        $this->form_validation->set_rules('code_materiel', 'code materiel', 'trim|required');
        $this->form_validation->set_rules('date_debut', 'date debut', 'trim|required');
        $this->form_validation->set_rules('date_fin', 'date fin', 'trim|required');
        $this->form_validation->set_rules('quantite_demande', 'quantite demande', 'trim|required|integer');
        $this->form_validation->set_rules('agent', 'agent', 'trim|required|integer');

        $this->form_validation->set_rules('num_demande', 'num_demande', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "demande.xls";
        $judul = "demande";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Date Creation Demande");
	xlsWriteLabel($tablehead, $kolomhead++, "Description Demande");
	xlsWriteLabel($tablehead, $kolomhead++, "Code Materiel");
	xlsWriteLabel($tablehead, $kolomhead++, "Quantite Demande");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat Demande");

	foreach ($this->Demande_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_creation_demande);
	    xlsWriteLabel($tablebody, $kolombody++, $data->description_demande);
	    xlsWriteNumber($tablebody, $kolombody++, $data->code_materiel);
	    xlsWriteNumber($tablebody, $kolombody++, $data->quantite_demande);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etat_demande);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Demande.php */
/* Location: ./application/controllers/Demande.php */

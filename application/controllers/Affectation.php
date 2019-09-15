<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Affectation extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Affectation_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'affectation/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'affectation/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'affectation/index.html';
            $config['first_url'] = base_url() . 'affectation/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Affectation_model->total_rows($q);
        $affectation = $this->Affectation_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'affectation_data' => $affectation,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('affectation/affectation_list', $data, true);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Affectation_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_affectation' => $row->id_affectation,
		'date_affectation' => $row->date_affectation,
		'is_actif' => $row->is_actif,
		'agent_id_agent' => $row->agent_id_agent,
		'poste_id_poste' => $row->poste_id_poste,
	    );
            $data['page'] = $this->load->view('affectation/affectation_read', $data, true);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('affectation'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('affectation/create_action'),
	    'id_affectation' => set_value('id_affectation'),
	    'date_affectation' => set_value('date_affectation'),
	    'is_actif' => set_value('is_actif'),
	    'agent_id_agent' => set_value('agent_id_agent'),
	    'poste_id_poste' => set_value('poste_id_poste'),
	);
        $data['page'] = $this->load->view('affectation/affectation_form', $data, true);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'date_affectation' => $this->input->post('date_affectation',TRUE),
		'is_actif' => $this->input->post('is_actif',TRUE),
		'agent_id_agent' => $this->input->post('agent_id_agent',TRUE),
		'poste_id_poste' => $this->input->post('poste_id_poste',TRUE),
	    );

            $this->Affectation_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('affectation'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Affectation_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('affectation/update_action'),
		'id_affectation' => set_value('id_affectation', $row->id_affectation),
		'date_affectation' => set_value('date_affectation', $row->date_affectation),
		'is_actif' => set_value('is_actif', $row->is_actif),
		'agent_id_agent' => set_value('agent_id_agent', $row->agent_id_agent),
		'poste_id_poste' => set_value('poste_id_poste', $row->poste_id_poste),
	    );
            $data['page'] = $this->load->view('affectation/affectation_form', $data, true);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('affectation'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_affectation', TRUE));
        } else {
            $data = array(
		'date_affectation' => $this->input->post('date_affectation',TRUE),
		'is_actif' => $this->input->post('is_actif',TRUE),
		'agent_id_agent' => $this->input->post('agent_id_agent',TRUE),
		'poste_id_poste' => $this->input->post('poste_id_poste',TRUE),
	    );

            $this->Affectation_model->update($this->input->post('id_affectation', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('affectation'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Affectation_model->get_by_id($id);

        if ($row) {
            $this->Affectation_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('affectation'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('affectation'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('date_affectation', 'date affectation', 'trim|required');
	$this->form_validation->set_rules('is_actif', 'is actif', 'trim|required');
	$this->form_validation->set_rules('agent_id_agent', 'agent id agent', 'trim|required');
	$this->form_validation->set_rules('poste_id_poste', 'poste id poste', 'trim|required');

	$this->form_validation->set_rules('id_affectation', 'id_affectation', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "affectation.xls";
        $judul = "affectation";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Date Affectation");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Actif");
	xlsWriteLabel($tablehead, $kolomhead++, "Agent Id Agent");
	xlsWriteLabel($tablehead, $kolomhead++, "Poste Id Poste");

	foreach ($this->Affectation_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_affectation);
	    xlsWriteLabel($tablebody, $kolombody++, $data->is_actif);
	    xlsWriteNumber($tablebody, $kolombody++, $data->agent_id_agent);
	    xlsWriteNumber($tablebody, $kolombody++, $data->poste_id_poste);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Affectation.php */
/* Location: ./application/controllers/Affectation.php */


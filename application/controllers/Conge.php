<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conge extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Conge_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'conge/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'conge/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'conge/index.html';
            $config['first_url'] = base_url() . 'conge/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Conge_model->total_rows($q);
        $conge = $this->Conge_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'conge_data' => $conge,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('conge/conge_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Conge_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_conge' => $row->id_conge,
		'type' => $row->type,
		'date_debut' => $row->date_debut,
		'date_fin' => $row->date_fin,
		'details' => $row->details,
		'agent_id_agent' => $row->agent_id_agent,
	    );
            $data['page'] = $this->load->view('conge/conge_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('conge'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('conge/create_action'),
	    'id_conge' => set_value('id_conge'),
	    'type' => set_value('type'),
	    'date_debut' => set_value('date_debut'),
	    'date_fin' => set_value('date_fin'),
	    'details' => set_value('details'),
	    'agent_id_agent' => set_value('agent_id_agent'),
	);
        $data['page'] = $this->load->view('conge/conge_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'type' => $this->input->post('type',TRUE),
		'date_debut' => $this->input->post('date_debut',TRUE),
		'date_fin' => $this->input->post('date_fin',TRUE),
		'details' => $this->input->post('details',TRUE),
		'agent_id_agent' => $this->input->post('agent_id_agent',TRUE),
	    );

            $this->Conge_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('conge'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Conge_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('conge/update_action'),
		'id_conge' => set_value('id_conge', $row->id_conge),
		'type' => set_value('type', $row->type),
		'date_debut' => set_value('date_debut', $row->date_debut),
		'date_fin' => set_value('date_fin', $row->date_fin),
		'details' => set_value('details', $row->details),
		'agent_id_agent' => set_value('agent_id_agent', $row->agent_id_agent),
	    );
            $data['page'] = $this->load->view('conge/conge_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('conge'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_conge', TRUE));
        } else {
            $data = array(
		'type' => $this->input->post('type',TRUE),
		'date_debut' => $this->input->post('date_debut',TRUE),
		'date_fin' => $this->input->post('date_fin',TRUE),
		'details' => $this->input->post('details',TRUE),
		'agent_id_agent' => $this->input->post('agent_id_agent',TRUE),
	    );

            $this->Conge_model->update($this->input->post('id_conge', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('conge'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Conge_model->get_by_id($id);

        if ($row) {
            $this->Conge_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('conge'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('conge'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('type', 'type', 'trim|required');
	$this->form_validation->set_rules('date_debut', 'date debut', 'trim|required');
	$this->form_validation->set_rules('date_fin', 'date fin', 'trim|required');
	$this->form_validation->set_rules('details', 'details', 'trim|required');
	$this->form_validation->set_rules('agent_id_agent', 'agent id agent', 'trim|required');

	$this->form_validation->set_rules('id_conge', 'id_conge', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "conge.xls";
        $judul = "conge";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Debut");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Fin");
	xlsWriteLabel($tablehead, $kolomhead++, "Details");
	xlsWriteLabel($tablehead, $kolomhead++, "Agent Id Agent");

	foreach ($this->Conge_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->type);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_debut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_fin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->details);
	    xlsWriteNumber($tablebody, $kolombody++, $data->agent_id_agent);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Conge.php */
/* Location: ./application/controllers/Conge.php */

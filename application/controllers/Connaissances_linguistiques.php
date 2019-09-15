<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Connaissances_linguistiques extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Connaissances_linguistiques_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'connaissances_linguistiques/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'connaissances_linguistiques/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'connaissances_linguistiques/index.html';
            $config['first_url'] = base_url() . 'connaissances_linguistiques/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Connaissances_linguistiques_model->total_rows($q);
        $connaissances_linguistiques = $this->Connaissances_linguistiques_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'connaissances_linguistiques_data' => $connaissances_linguistiques,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('connaissances_linguistiques/connaissances_linguistiques_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Connaissances_linguistiques_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_langue_parler' => $row->id_langue_parler,
		'lecture' => $row->lecture,
		'ecriture' => $row->ecriture,
		'parler' => $row->parler,
		'comprendre' => $row->comprendre,
		'agent_id_agent' => $row->agent_id_agent,
	    );
            $data['page'] = $this->load->view('connaissances_linguistiques/connaissances_linguistiques_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('connaissances_linguistiques'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('connaissances_linguistiques/create_action'),
	    'id_langue_parler' => set_value('id_langue_parler'),
	    'lecture' => set_value('lecture'),
	    'ecriture' => set_value('ecriture'),
	    'parler' => set_value('parler'),
	    'comprendre' => set_value('comprendre'),
	    'agent_id_agent' => set_value('agent_id_agent'),
	);
        $this->load->view('connaissances_linguistiques/connaissances_linguistiques_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'lecture' => $this->input->post('lecture',TRUE),
		'ecriture' => $this->input->post('ecriture',TRUE),
		'parler' => $this->input->post('parler',TRUE),
		'comprendre' => $this->input->post('comprendre',TRUE),
		'agent_id_agent' => $this->input->post('agent_id_agent',TRUE),
	    );

            $this->Connaissances_linguistiques_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('connaissances_linguistiques'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Connaissances_linguistiques_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('connaissances_linguistiques/update_action'),
		'id_langue_parler' => set_value('id_langue_parler', $row->id_langue_parler),
		'lecture' => set_value('lecture', $row->lecture),
		'ecriture' => set_value('ecriture', $row->ecriture),
		'parler' => set_value('parler', $row->parler),
		'comprendre' => set_value('comprendre', $row->comprendre),
		'agent_id_agent' => set_value('agent_id_agent', $row->agent_id_agent),
	    );
            $data['page'] = $this->load->view('connaissances_linguistiques/connaissances_linguistiques_form', $data, TRUE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('connaissances_linguistiques'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_langue_parler', TRUE));
        } else {
            $data = array(
		'lecture' => $this->input->post('lecture',TRUE),
		'ecriture' => $this->input->post('ecriture',TRUE),
		'parler' => $this->input->post('parler',TRUE),
		'comprendre' => $this->input->post('comprendre',TRUE),
		'agent_id_agent' => $this->input->post('agent_id_agent',TRUE),
	    );

            $this->Connaissances_linguistiques_model->update($this->input->post('id_langue_parler', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('connaissances_linguistiques'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Connaissances_linguistiques_model->get_by_id($id);

        if ($row) {
            $this->Connaissances_linguistiques_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('connaissances_linguistiques'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('connaissances_linguistiques'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('lecture', 'lecture', 'trim|required');
	$this->form_validation->set_rules('ecriture', 'ecriture', 'trim|required');
	$this->form_validation->set_rules('parler', 'parler', 'trim|required');
	$this->form_validation->set_rules('comprendre', 'comprendre', 'trim|required');
	$this->form_validation->set_rules('agent_id_agent', 'agent id agent', 'trim|required');

	$this->form_validation->set_rules('id_langue_parler', 'id_langue_parler', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "connaissances_linguistiques.xls";
        $judul = "connaissances_linguistiques";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Lecture");
	xlsWriteLabel($tablehead, $kolomhead++, "Ecriture");
	xlsWriteLabel($tablehead, $kolomhead++, "Parler");
	xlsWriteLabel($tablehead, $kolomhead++, "Comprendre");
	xlsWriteLabel($tablehead, $kolomhead++, "Agent Id Agent");

	foreach ($this->Connaissances_linguistiques_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->lecture);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ecriture);
	    xlsWriteNumber($tablebody, $kolombody++, $data->parler);
	    xlsWriteNumber($tablebody, $kolombody++, $data->comprendre);
	    xlsWriteNumber($tablebody, $kolombody++, $data->agent_id_agent);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Connaissances_linguistiques.php */
/* Location: ./application/controllers/Connaissances_linguistiques.php */

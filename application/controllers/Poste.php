<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poste extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Poste_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'poste/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'poste/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'poste/index.html';
            $config['first_url'] = base_url() . 'poste/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Poste_model->total_rows($q);
        $poste = $this->Poste_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'poste_data' => $poste,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('poste/poste_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Poste_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_poste' => $row->id_poste,
		'nom_poste' => $row->nom_poste,
		'description' => $row->description,
		'type' => $row->type,
	    );
            $data['page'] = $this->load->view('poste/poste_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('poste'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('poste/create_action'),
	    'id_poste' => set_value('id_poste'),
	    'nom_poste' => set_value('nom_poste'),
	    'description' => set_value('description'),
	    'type' => set_value('type'),
	);
        $data['page'] = $this->load->view('poste/poste_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nom_poste' => $this->input->post('nom_poste',TRUE),
		'description' => $this->input->post('description',TRUE),
		'type' => $this->input->post('type',TRUE),
	    );

            $this->Poste_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('poste'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Poste_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('poste/update_action'),
		'id_poste' => set_value('id_poste', $row->id_poste),
		'nom_poste' => set_value('nom_poste', $row->nom_poste),
		'description' => set_value('description', $row->description),
		'type' => set_value('type', $row->type),
	    );
            $data['page'] = $this->load->view('poste/poste_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('poste'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_poste', TRUE));
        } else {
            $data = array(
		'nom_poste' => $this->input->post('nom_poste',TRUE),
		'description' => $this->input->post('description',TRUE),
		'type' => $this->input->post('type',TRUE),
	    );

            $this->Poste_model->update($this->input->post('id_poste', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('poste'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Poste_model->get_by_id($id);

        if ($row) {
            $this->Poste_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('poste'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('poste'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nom_poste', 'nom poste', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('type', 'type', 'trim|required');

	$this->form_validation->set_rules('id_poste', 'id_poste', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "poste.xls";
        $judul = "poste";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nom Poste");
	xlsWriteLabel($tablehead, $kolomhead++, "Description");
	xlsWriteLabel($tablehead, $kolomhead++, "Type");

	foreach ($this->Poste_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nom_poste);
	    xlsWriteLabel($tablebody, $kolombody++, $data->description);
	    xlsWriteLabel($tablebody, $kolombody++, $data->type);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Poste.php */
/* Location: ./application/controllers/Poste.php */

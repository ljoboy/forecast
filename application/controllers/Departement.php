<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Departement extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Departement_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'departement/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'departement/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'departement/index.html';
            $config['first_url'] = base_url() . 'departement/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Departement_model->total_rows($q);
        $departement = $this->Departement_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'departement_data' => $departement,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('departement/departement_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Departement_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_departement' => $row->id_departement,
		'nom_departement' => $row->nom_departement,
		'description' => $row->description,
	    );
            $data['page'] = $this->load->view('departement/departement_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departement'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('departement/create_action'),
	    'id_departement' => set_value('id_departement'),
	    'nom_departement' => set_value('nom_departement'),
	    'description' => set_value('description'),
	);
        $data['page'] = $this->load->view('departement/departement_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nom_departement' => $this->input->post('nom_departement',TRUE),
		'description' => $this->input->post('description',TRUE),
	    );

            $this->Departement_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('departement'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Departement_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('departement/update_action'),
		'id_departement' => set_value('id_departement', $row->id_departement),
		'nom_departement' => set_value('nom_departement', $row->nom_departement),
		'description' => set_value('description', $row->description),
	    );
            $data['page'] = $this->load->view('departement/departement_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departement'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_departement', TRUE));
        } else {
            $data = array(
		'nom_departement' => $this->input->post('nom_departement',TRUE),
		'description' => $this->input->post('description',TRUE),
	    );

            $this->Departement_model->update($this->input->post('id_departement', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('departement'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Departement_model->get_by_id($id);

        if ($row) {
            $this->Departement_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('departement'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departement'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nom_departement', 'nom departement', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');

	$this->form_validation->set_rules('id_departement', 'id_departement', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "departement.xls";
        $judul = "departement";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nom Departement");
	xlsWriteLabel($tablehead, $kolomhead++, "Description");

	foreach ($this->Departement_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nom_departement);
	    xlsWriteLabel($tablebody, $kolombody++, $data->description);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Departement.php */
/* Location: ./application/controllers/Departement.php */

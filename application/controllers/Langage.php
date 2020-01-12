<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Langage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Langage_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'langage/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'langage/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'langage/index.html';
            $config['first_url'] = base_url() . 'langage/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Langage_model->total_rows($q);
        $langage = $this->Langage_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'langage_data' => $langage,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('langage/langage_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Langage_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_langage' => $row->id_langage,
		'nom_langage' => $row->nom_langage,
		'description' => $row->description,
		'connaissances_linguistiques_id_langue_parler' => $row->connaissances_linguistiques_id_langue_parler,
	    );
            $data['page'] = $this->load->view('langage/langage_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('langage'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('langage/create_action'),
	    'id_langage' => set_value('id_langage'),
	    'nom_langage' => set_value('nom_langage'),
	    'description' => set_value('description'),
	    'connaissances_linguistiques_id_langue_parler' => set_value('connaissances_linguistiques_id_langue_parler'),
	);
        $data['page'] = $this->load->view('langage/langage_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nom_langage' => $this->input->post('nom_langage',TRUE),
		'description' => $this->input->post('description',TRUE),
		'connaissances_linguistiques_id_langue_parler' => $this->input->post('connaissances_linguistiques_id_langue_parler',TRUE),
	    );

            $this->Langage_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('langage'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Langage_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('langage/update_action'),
		'id_langage' => set_value('id_langage', $row->id_langage),
		'nom_langage' => set_value('nom_langage', $row->nom_langage),
		'description' => set_value('description', $row->description),
		'connaissances_linguistiques_id_langue_parler' => set_value('connaissances_linguistiques_id_langue_parler', $row->connaissances_linguistiques_id_langue_parler),
	    );
            $data['page'] = $this->load->view('langage/langage_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('langage'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_langage', TRUE));
        } else {
            $data = array(
		'nom_langage' => $this->input->post('nom_langage',TRUE),
		'description' => $this->input->post('description',TRUE),
		'connaissances_linguistiques_id_langue_parler' => $this->input->post('connaissances_linguistiques_id_langue_parler',TRUE),
	    );

            $this->Langage_model->update($this->input->post('id_langage', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('langage'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Langage_model->get_by_id($id);

        if ($row) {
            $this->Langage_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('langage'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('langage'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nom_langage', 'nom langage', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('connaissances_linguistiques_id_langue_parler', 'connaissances linguistiques id langue parler', 'trim|required');

	$this->form_validation->set_rules('id_langage', 'id_langage', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "langage.xls";
        $judul = "langage";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nom Langage");
	xlsWriteLabel($tablehead, $kolomhead++, "Description");
	xlsWriteLabel($tablehead, $kolomhead++, "Connaissances Linguistiques Id Langue Parler");

	foreach ($this->Langage_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nom_langage);
	    xlsWriteLabel($tablebody, $kolombody++, $data->description);
	    xlsWriteNumber($tablebody, $kolombody++, $data->connaissances_linguistiques_id_langue_parler);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Langage.php */
/* Location: ./application/controllers/Langage.php */

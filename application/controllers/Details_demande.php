<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Details_demande extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Details_demande_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'details_demande/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'details_demande/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'details_demande/index.html';
            $config['first_url'] = base_url() . 'details_demande/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Details_demande_model->total_rows($q);
        $details_demande = $this->Details_demande_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'details_demande_data' => $details_demande,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('details_demande/details_demande_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Details_demande_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_details_demande' => $row->id_details_demande,
		'quantite_demande' => $row->quantite_demande,
		'demande_num_demande' => $row->demande_num_demande,
		'materiel_code_materiel' => $row->materiel_code_materiel,
	    );
            $data['page'] = $this->load->view('details_demande/details_demande_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('details_demande'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('details_demande/create_action'),
	    'id_details_demande' => set_value('id_details_demande'),
	    'quantite_demande' => set_value('quantite_demande'),
	    'demande_num_demande' => set_value('demande_num_demande'),
	    'materiel_code_materiel' => set_value('materiel_code_materiel'),
	);
        $data['page'] = $this->load->view('details_demande/details_demande_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'quantite_demande' => $this->input->post('quantite_demande',TRUE),
		'demande_num_demande' => $this->input->post('demande_num_demande',TRUE),
		'materiel_code_materiel' => $this->input->post('materiel_code_materiel',TRUE),
	    );

            $this->Details_demande_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('details_demande'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Details_demande_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('details_demande/update_action'),
		'id_details_demande' => set_value('id_details_demande', $row->id_details_demande),
		'quantite_demande' => set_value('quantite_demande', $row->quantite_demande),
		'demande_num_demande' => set_value('demande_num_demande', $row->demande_num_demande),
		'materiel_code_materiel' => set_value('materiel_code_materiel', $row->materiel_code_materiel),
	    );
            $data['page'] = $this->load->view('details_demande/details_demande_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('details_demande'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_details_demande', TRUE));
        } else {
            $data = array(
		'quantite_demande' => $this->input->post('quantite_demande',TRUE),
		'demande_num_demande' => $this->input->post('demande_num_demande',TRUE),
		'materiel_code_materiel' => $this->input->post('materiel_code_materiel',TRUE),
	    );

            $this->Details_demande_model->update($this->input->post('id_details_demande', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('details_demande'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Details_demande_model->get_by_id($id);

        if ($row) {
            $this->Details_demande_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('details_demande'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('details_demande'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('quantite_demande', 'quantite demande', 'trim|required');
	$this->form_validation->set_rules('demande_num_demande', 'demande num demande', 'trim|required');
	$this->form_validation->set_rules('materiel_code_materiel', 'materiel code materiel', 'trim|required');

	$this->form_validation->set_rules('id_details_demande', 'id_details_demande', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "details_demande.xls";
        $judul = "details_demande";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Quantite Demande");
	xlsWriteLabel($tablehead, $kolomhead++, "Demande Num Demande");
	xlsWriteLabel($tablehead, $kolomhead++, "Materiel Code Materiel");

	foreach ($this->Details_demande_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->quantite_demande);
	    xlsWriteNumber($tablebody, $kolombody++, $data->demande_num_demande);
	    xlsWriteNumber($tablebody, $kolombody++, $data->materiel_code_materiel);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Details_demande.php */
/* Location: ./application/controllers/Details_demande.php */

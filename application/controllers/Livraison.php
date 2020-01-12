<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Livraison extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Livraison_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'livraison/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'livraison/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'livraison/index.html';
            $config['first_url'] = base_url() . 'livraison/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Livraison_model->total_rows($q);
        $livraison = $this->Livraison_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'livraison_data' => $livraison,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = $this->load->view('livraison/livraison_list', $data);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Livraison_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_livraison' => $row->id_livraison,
		'quantite_livree' => $row->quantite_livree,
		'date_livraison' => $row->date_livraison,
		'date_creation' => $row->date_creation,
		'sortie_id_sortie' => $row->sortie_id_sortie,
	    );
            $data['page'] = $this->load->view('livraison/livraison_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('livraison'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('livraison/create_action'),
	    'id_livraison' => set_value('id_livraison'),
	    'quantite_livree' => set_value('quantite_livree'),
	    'date_livraison' => set_value('date_livraison'),
	    'date_creation' => set_value('date_creation'),
	    'sortie_id_sortie' => set_value('sortie_id_sortie'),
	);
        $data['page'] = $this->load->view('livraison/livraison_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'quantite_livree' => $this->input->post('quantite_livree',TRUE),
		'date_livraison' => $this->input->post('date_livraison',TRUE),
		'date_creation' => $this->input->post('date_creation',TRUE),
		'sortie_id_sortie' => $this->input->post('sortie_id_sortie',TRUE),
	    );

            $this->Livraison_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('livraison'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Livraison_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('livraison/update_action'),
		'id_livraison' => set_value('id_livraison', $row->id_livraison),
		'quantite_livree' => set_value('quantite_livree', $row->quantite_livree),
		'date_livraison' => set_value('date_livraison', $row->date_livraison),
		'date_creation' => set_value('date_creation', $row->date_creation),
		'sortie_id_sortie' => set_value('sortie_id_sortie', $row->sortie_id_sortie),
	    );
            $data['page'] = $this->load->view('livraison/livraison_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('livraison'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_livraison', TRUE));
        } else {
            $data = array(
		'quantite_livree' => $this->input->post('quantite_livree',TRUE),
		'date_livraison' => $this->input->post('date_livraison',TRUE),
		'date_creation' => $this->input->post('date_creation',TRUE),
		'sortie_id_sortie' => $this->input->post('sortie_id_sortie',TRUE),
	    );

            $this->Livraison_model->update($this->input->post('id_livraison', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('livraison'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Livraison_model->get_by_id($id);

        if ($row) {
            $this->Livraison_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('livraison'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('livraison'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('quantite_livree', 'quantite livree', 'trim|required');
	$this->form_validation->set_rules('date_livraison', 'date livraison', 'trim|required');
	$this->form_validation->set_rules('date_creation', 'date creation', 'trim|required');
	$this->form_validation->set_rules('sortie_id_sortie', 'sortie id sortie', 'trim|required');

	$this->form_validation->set_rules('id_livraison', 'id_livraison', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "livraison.xls";
        $judul = "livraison";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Quantite Livree");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Livraison");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Creation");
	xlsWriteLabel($tablehead, $kolomhead++, "Sortie Id Sortie");

	foreach ($this->Livraison_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->quantite_livree);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_livraison);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_creation);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sortie_id_sortie);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Livraison.php */
/* Location: ./application/controllers/Livraison.php */

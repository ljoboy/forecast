<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tache extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tache_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tache/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tache/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tache/index.html';
            $config['first_url'] = base_url() . 'tache/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tache_model->total_rows($q);
        $tache = $this->Tache_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tache_data' => $tache,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tache/tache_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tache_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_tache' => $row->id_tache,
		'tache' => $row->tache,
		'date_debut' => $row->date_debut,
		'date_fin' => $row->date_fin,
		'date_assignement' => $row->date_assignement,
		'etat' => $row->etat,
		'details' => $row->details,
	    );
            $data['page'] = $this->load->view('tache/tache_read', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tache'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tache/create_action'),
	    'id_tache' => set_value('id_tache'),
	    'tache' => set_value('tache'),
	    'date_debut' => set_value('date_debut'),
	    'date_fin' => set_value('date_fin'),
	    'date_assignement' => set_value('date_assignement'),
	    'etat' => set_value('etat'),
	    'details' => set_value('details'),
	);
        $data['page'] = $this->load->view('tache/tache_form', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tache' => $this->input->post('tache',TRUE),
		'date_debut' => $this->input->post('date_debut',TRUE),
		'date_fin' => $this->input->post('date_fin',TRUE),
		'date_assignement' => $this->input->post('date_assignement',TRUE),
		'etat' => $this->input->post('etat',TRUE),
		'details' => $this->input->post('details',TRUE),
	    );

            $this->Tache_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tache'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tache_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tache/update_action'),
		'id_tache' => set_value('id_tache', $row->id_tache),
		'tache' => set_value('tache', $row->tache),
		'date_debut' => set_value('date_debut', $row->date_debut),
		'date_fin' => set_value('date_fin', $row->date_fin),
		'date_assignement' => set_value('date_assignement', $row->date_assignement),
		'etat' => set_value('etat', $row->etat),
		'details' => set_value('details', $row->details),
	    );
            $data['page'] = $this->load->view('tache/tache_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tache'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tache', TRUE));
        } else {
            $data = array(
		'tache' => $this->input->post('tache',TRUE),
		'date_debut' => $this->input->post('date_debut',TRUE),
		'date_fin' => $this->input->post('date_fin',TRUE),
		'date_assignement' => $this->input->post('date_assignement',TRUE),
		'etat' => $this->input->post('etat',TRUE),
		'details' => $this->input->post('details',TRUE),
	    );

            $this->Tache_model->update($this->input->post('id_tache', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tache'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tache_model->get_by_id($id);

        if ($row) {
            $this->Tache_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tache'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tache'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tache', 'tache', 'trim|required');
	$this->form_validation->set_rules('date_debut', 'date debut', 'trim|required');
	$this->form_validation->set_rules('date_fin', 'date fin', 'trim|required');
	$this->form_validation->set_rules('date_assignement', 'date assignement', 'trim|required');
	$this->form_validation->set_rules('etat', 'etat', 'trim|required');
	$this->form_validation->set_rules('details', 'details', 'trim|required');

	$this->form_validation->set_rules('id_tache', 'id_tache', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tache.xls";
        $judul = "tache";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tache");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Debut");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Fin");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Assignement");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat");
	xlsWriteLabel($tablehead, $kolomhead++, "Details");

	foreach ($this->Tache_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tache);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_debut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_fin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_assignement);
	    xlsWriteLabel($tablebody, $kolombody++, $data->etat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->details);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tache.php */
/* Location: ./application/controllers/Tache.php */

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sortie extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sortie_model');
        $this->load->library('form_validation');
        $this->load->model('Materiel_model');
    }

    public function index()
    {
        $data = array(
            'sortie_data' => $this->Sortie_model->get_all(),
            'start' => 0,
        );
        $data['page'] = $this->load->view('sortie/sortie_list', $data, TRUE);
        $this->load->view('layouts/main', $data, FALSE);
    }

    public function read($id) 
    {
        $row = $this->Sortie_model->get_by_id($id);
        if ($row) {
                $data = array(
                'id_sortie' => $row->id_sortie,
                'date_sortie' => $row->date_sortie,
                'qte_sortie' => $row->qte_sortie,
                'motif_sortie' => $row->motif_sortie,
                'materiel_code_materiel' => $row->materiel_code_materiel,
            );
            $this->load->view('sortie/sortie_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sortie'));
        }
    }

    public function create($id)
    {
        $materiel =  $this->Materiel_model->get_by_id($id);
        if ($materiel){
            $data = array(
                'action' => site_url('sortie/create_action/'.$id),
                'id_sortie' => set_value('id_sortie'),
                'date_sortie' => set_value('date_sortie'),
                'qte_sortie' => set_value('qte_sortie'),
                'motif_sortie' => set_value('motif_sortie'),
                'materiel_code_materiel' => set_value('materiel_code_materiel'),
                'materiel' => $materiel
            );
            $data['page'] = $this->load->view('sortie/sortie_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        }else{
            redirect('materiel/index');
        }

    }
    
    public function create_action($id)
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create($id);
        } else {
            $code = $this->input->post('materiel_code_materiel',TRUE);
            $qte =  $this->input->post('qte_sortie',TRUE);
            $qte_mat = $this->input->post('qte_stock',TRUE);
            $data = array(
                'date_sortie' => $this->input->post('date_sortie',TRUE),
                'qte_sortie' => $qte,
                'motif_sortie' => $this->input->post('motif_sortie',TRUE),
                'materiel_code_materiel' => $code,
            );
            $this->Sortie_model->insert($data);
            $materiel = array('quantite_stock' => ($qte_mat - $qte));
            $this->Materiel_model->update($code, $materiel);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('materiel'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sortie_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sortie/update_action'),
                'id_sortie' => set_value('id_sortie', $row->id_sortie),
                'date_sortie' => set_value('date_sortie', $row->date_sortie),
                'date_enregistrer' => set_value('date_enregistrer', $row->date_enregistrer),
                'qte_sortie' => set_value('qte_sortie', $row->qte_sortie),
                'motif_sortie' => set_value('motif_sortie', $row->motif_sortie),
                'materiel_code_materiel' => set_value('materiel_code_materiel', $row->materiel_code_materiel),
            );
            $data['page'] = $this->load->view('sortie/sortie_form', $data, TRUE);
            $this->load->view('layouts/main', $data, FALSE);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sortie'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_sortie', TRUE));
        } else {
            $data = array(
                'date_sortie' => $this->input->post('date_sortie',TRUE),
                'date_enregistrer' => $this->input->post('date_enregistrer',TRUE),
                'qte_sortie' => $this->input->post('qte_sortie',TRUE),
                'motif_sortie' => $this->input->post('motif_sortie',TRUE),
                'materiel_code_materiel' => $this->input->post('materiel_code_materiel',TRUE),
            );

            $this->Sortie_model->update($this->input->post('id_sortie', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sortie'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sortie_model->get_by_id($id);

        if ($row) {
            $this->Sortie_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sortie'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sortie'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('date_sortie', 'date sortie', 'trim|required');
        $this->form_validation->set_rules('qte_sortie', 'qte sortie', 'trim|required');
        $this->form_validation->set_rules('motif_sortie', 'motif sortie', 'trim');
        $this->form_validation->set_rules('materiel_code_materiel', 'materiel code materiel', 'trim|required');

        $this->form_validation->set_rules('id_sortie', 'id_sortie', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sortie.xls";
        $judul = "sortie";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Date Sortie");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Enregistrer");
        xlsWriteLabel($tablehead, $kolomhead++, "Qte Sortie");
        xlsWriteLabel($tablehead, $kolomhead++, "Motif Sortie");
        xlsWriteLabel($tablehead, $kolomhead++, "Materiel Code Materiel");

	foreach ($this->Sortie_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->date_sortie);
            xlsWriteLabel($tablebody, $kolombody++, $data->date_enregistrer);
            xlsWriteNumber($tablebody, $kolombody++, $data->qte_sortie);
            xlsWriteLabel($tablebody, $kolombody++, $data->motif_sortie);
            xlsWriteNumber($tablebody, $kolombody++, $data->materiel_code_materiel);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Sortie.php */
/* Location: ./application/controllers/Sortie.php */

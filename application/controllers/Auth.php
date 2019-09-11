<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

	public function index()
	{
	    if (isset($this->session->is_connected))
            redirect();

	    $data = array();
        $this->load->view('layouts/login', $data, FALSE);
	}

    public function login()
    {
        if (isset($this->session->is_connected))
            redirect();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', "nom d'utilisateur", 'trim|required', ['required' => 'Le %s est obligatoire']);
        $this->form_validation->set_rules('password', 'mot de passe', 'required', ['required' => 'Le %s est obligatoire']);

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username', true);
            $password = sha1($this->input->post('password'));
            $user = $this->auth_model->login($username, $password);
            if ($user != null) {
                $array = array(
                    'id' => $user->id,
                    'username' => $user->username,
                    'is_connected' => true
                );

                $this->session->set_userdata($array);
                $this->session->set_flashdata('success', "<h3>Bienvenue " . strtoupper($user->username) . "</h3>");
                redirect();
            } else {
                $this->session->set_flashdata('login_error', "<h3>Echec d'authentification !</h3> Combinaison <strong>username / Mot de passe</strong> Incorrecte !");
                $this->index();
            }
        } else {
            $this->session->set_flashdata('login_error', "Veuillez remplir tous les champs obligatoires svp !");
            $this->index();
        }
	}

    function logout()
    {
        $this->session->unset_userdata('is_connected');
        redirect();
    }

}

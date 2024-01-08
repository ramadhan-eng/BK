<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dokter/periksa_model'); // Load the model in the constructor
    }

    public function index()
    {
        $data['daftar_poli'] = $this->periksa_model->SemuaData();

        $this->load->view('dokter/navbar');
        $this->load->view('dokter/dokter_message', $data);
        $this->load->view('dokter/sidebar');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}

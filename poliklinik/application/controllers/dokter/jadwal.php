<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jadwal_model'); // Load the model in the constructor
    }

    public function index()
    {
        $data['jadwal_periksa'] = $this->jadwal_model->SemuaData();
        $this->load->view('dokter/navbar');
        $this->load->view('dokter/jadwal', $data);
        $this->load->view('dokter/sidebar');
    }
}

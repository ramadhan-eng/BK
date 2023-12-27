<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('riwayat_model'); // Load the model in the constructor
    }

    public function index()
    {
        $data['riwayat_periksa'] = $this->riwayat_model->SemuaData();
        $this->load->view('dokter/navbar');
        $this->load->view('dokter/riwayat', $data);
        $this->load->view('dokter/sidebar');
    }
}

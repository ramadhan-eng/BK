<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dokter/detail_model'); // Load the model in the constructor
    }

    public function index($id_pasien, $nama_pasien, $id_periksa)
    {
        // Fetch details from the database using your model
        $data['detail_periksa'] = $this->detail_model->getDetailPeriksaData($id_periksa);
        $this->load->view('dokter/navbar');
        $this->load->view('dokter/detail_riwayat', $data);
        $this->load->view('dokter/sidebar');
    }
}

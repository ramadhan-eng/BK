<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dokter/jadwal_model'); // Load the model in the constructor
    }

    public function index()
    {
        $data['jadwal_periksa'] = $this->jadwal_model->SemuaData();
        $this->load->view('dokter/navbar');
        $this->load->view('dokter/jadwal', $data);
        $this->load->view('dokter/sidebar');
    }

    public function tambah()
    {
        // Assuming you have a form submitting POST data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array(
                'hari' => $this->input->post('hari'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai')
                // Add other fields as needed
            );

            // Call the model to add data
            $this->jadwal_model->tambah_data($data);

            // Redirect or show success message
            redirect('dokter/jadwal');
        } else {
            // Display the form
            $this->load->view('form_tambah');
        }
    }
}
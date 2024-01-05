<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    public function index()
    {
        // Load the session library
        $this->load->library('session');
        $this->load->model('pasien/pasien_model');

        // Check if the user is logged in
        if ($this->session->userdata('logged_in')) {
            // Get necessary data from session
            $no_rm = $this->session->userdata('user_no_rm');

            // Pass the data to the view
            $data['no_rm'] = $no_rm;

            // Load the patient registration history data from the model
            $patient_id = $this->pasien_model->get_pasien_id_by_no_rm($no_rm);
            $data['riwayat_poli'] = $this->pasien_model->get_riwayat_daftar_poli($patient_id);

            // Load the pasien view
            $this->load->view('pasien/navbar');
            $this->load->view('pasien/pasien_message', $data);
            $this->load->view('pasien/sidebar');
        } else {
            // If not logged in, redirect to login page
            redirect('login');
        }
    }

    // controllers/Pasien.php
    public function get_jadwal_by_poli()
    {
        $poli_id = $this->input->post('id_poli'); // Assuming you are using POST method for AJAX

        // Load your model
        $this->load->model('pasien/pasien_model');

        // Call the model method to get jadwal based on poli_id
        $jadwal_data = $this->pasien_model->get_jadwal_by_poli($poli_id);

        // Return the jadwal data as JSON
        echo json_encode($jadwal_data);
    }

    public function register_poli()
    {
        // Load necessary libraries and models
        $this->load->library('session');
        $this->load->model('pasien/pasien_model');

        // Check if the user is logged in
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to login page
            redirect('login');
        }

        // Get necessary data from session
        $no_rm = $this->session->userdata('user_no_rm');

        // Additional data from the form
        $id_poli = $this->input->post('id_poli');
        $id_jadwal = $this->input->post('id_jadwal');
        $keluhan = $this->input->post('keluhan');

        // Check if keluhan is set, otherwise set a default value
        $keluhan = $keluhan ? $keluhan : 'No Keluhan';

        // Look up the id in the pasien table based on no_rm
        $patient_id = $this->pasien_model->get_pasien_id_by_no_rm($no_rm);

        if (!$patient_id) {
            // Redirect or handle the case where the patient doesn't exist
            redirect('pasien'); // Redirect to the patient index page or handle accordingly
        }


        $lastQueueNumber = $this->pasien_model->get_last_queue_number_by_jadwal($id_jadwal);

        // Increment the queue number
        $nextQueueNumber = $lastQueueNumber + 1;
        // Insert data into daftar_poli table
        $data = array(
            'id_pasien' => $patient_id,
            'id_jadwal' => $id_jadwal,
            'keluhan' => $keluhan,
            'no_antri' => $nextQueueNumber
        );

        $this->pasien_model->insert_daftar_poli($data);

        // Redirect or do anything else as needed
        redirect('pasien/pasien/index'); // Redirect to the patient index page
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periksa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dokter/periksa_model'); // Load the model in the constructor
    }

    public function index($id_pasien, $nama_pasien)
    {
        // Fetch patient name based on $id_pasien
        $data['namapasien'] = $this->periksa_model->getPatientName();

        $nama_pasien = urldecode($nama_pasien);
        $data['namapasien'] = $nama_pasien;

        $this->load->view('dokter/navbar');
        $this->load->view('dokter/form_periksa', $data);
        $this->load->view('dokter/sidebar');
    }


    public function submit_periksa()
    {
        // Retrieve form data
        $nama_pasien = $this->input->post('nama_pasien');
        $tgl_periksa = $this->input->post('tgl_periksa');
        $catatan = $this->input->post('catatan');
        $obat_ids = $this->input->post('obat');
        $harga = $this->input->post('harga');

        // Calculate 'biaya_periksa' by adding 50000 to 'harga'

        // Insert data into 'periksa' table
        $id_periksa = $this->periksa_model->insert_periksa($nama_pasien, $tgl_periksa, $catatan, $harga);

        if ($id_periksa) {
            // Insert selected obat data into 'detail_periksa' table
            if (!empty($obat_ids)) {
                foreach ($obat_ids as $obat_id) {
                    $inserted = $this->periksa_model->insert_detail_periksa($id_periksa, $obat_id);
                    if (!$inserted) {
                        // Handle the case when insertion into 'detail_periksa' fails
                        redirect('error_page');
                    }
                }
            }

            // Redirect to 'dokter/dokter' controller
            redirect('dokter/dokter');
        } else {
            // Handle the case when insertion into 'periksa' fails
            redirect('error_page');
        }
    }
}

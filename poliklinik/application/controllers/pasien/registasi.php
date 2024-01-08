<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registasi extends CI_Controller
{
    public function index()
    {
        $this->load->view('pasien/registasi_message');
    }

    public function process()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Load the database library and form validation
            $this->load->model('pasien/pasien_model');
            $this->load->library('form_validation');

            // Define validation rules
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('no_ktp', 'No KTP', 'trim|required|is_unique[pasien.no_ktp]');
            $this->form_validation->set_rules('no_hp', 'No HP', 'trim|required');

            // Run validation
            if ($this->form_validation->run() === FALSE) {
                // Validation failed, redirect back to the registration form
                $this->load->view('pasien/registasi_message');
            } else {
                // Validation passed, continue with registration process

                $nama = $this->input->post('nama');
                $alamat = $this->input->post('alamat');
                $no_ktp = $this->input->post('no_ktp');
                $no_hp = $this->input->post('no_hp');

                // Check if the patient is already registered based on NIK
                $existing_patient = $this->pasien_model->get_pasien_by_no_ktp($no_ktp);

                if (!empty($existing_patient)) {
                    // User with the same no_ktp already exists
                    echo "<script>alert('User with the same NIK already exists');</script>";
                    echo "<meta http-equiv='refresh' content='0; url=pasien/registasi'>";
                    die();
                }

                // -----SITUATION 2-----
                // Query to get the last queue number YYYYMM-XXX = 202401-001
                $lastQueueNumber = $this->pasien_model->get_last_queue_number();
                $lastQueueNumber = $lastQueueNumber ? $lastQueueNumber : 0;

                $tahun_bulan = date("Ym");
                $newQueueNumber = $lastQueueNumber + 1;
                $no_rm = $tahun_bulan . "-" . str_pad($newQueueNumber, 3, '0', STR_PAD_LEFT);

                // Insert operation
                $data = [
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'no_ktp' => $no_ktp,
                    'no_hp' => $no_hp,
                    'no_rm' => $no_rm
                ];

                // Insert data using the model method
                $inserted_id = $this->pasien_model->insert_pasien($data);

                if ($inserted_id) {
                    $this->session->set_userdata([
                        'signup' => true,
                        'id' => $inserted_id,
                        'usernam' => $nama,
                        'no_rm' => $no_rm,
                        'akses' => 'pasien'
                    ]);

                    // Redirect to Pasien controller and index method
                    redirect('pasien/pasien/index');
                } else {
                    echo "Gagal Simpan Data!";
                }
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('pasien/login');
    }
}

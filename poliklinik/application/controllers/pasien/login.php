<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('pasien/login');
    }

    public function process_login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $this->input->post('nama');
            $no_ktp = $this->input->post('no_ktp');

            // Load the database library and model
            $this->load->model('pasien/login_model');

            // Check if the user exists in the database
            $user = $this->login_model->get_pasien_by_name_and_no_ktp($nama, $no_ktp);

            if ($user) {
                // User exists, set session data or perform other authentication tasks
                $this->session->set_userdata([
                    'user_id' => $user['id'],
                    'user_name' => $user['nama'],
                    'user_no_ktp' => $user['no_ktp'],
                    'user_no_rm' => $user['no_rm'], // Add 'user_no_rm' to session
                    'logged_in' => TRUE
                ]);

                // Redirect to a dashboard or another page
                redirect('pasien/pasien/index');
            } else {
                // User not found, display an error message or redirect to login page
                $data['error_message'] = 'Invalid credentials. Please try again.';
                $this->load->view('pasien/login', $data);
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('pasien/login');
    }
}

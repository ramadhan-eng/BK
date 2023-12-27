<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('login_message');
	}

	public function process_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');

		$result = $this->login_model->validate_login($username, $password, $role);

		if ($result) {
			// Successful login
			if ($role === 'admin') {
				// Redirect to admin dashboard
				redirect('admin/admin');
			} elseif ($role === 'dokter') {
				// Redirect to doctor dashboard
				redirect('dokter/dokter');
			}
		} else {
			// Invalid login, redirect back to login form with an error message
			$this->session->set_flashdata('error_message', 'Invalid username, password, or role');
			redirect('login');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}

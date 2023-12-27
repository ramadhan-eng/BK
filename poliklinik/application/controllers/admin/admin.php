<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('obat_model'); // Load the model in the constructor

    }
    public function index()
    {
        $data['menu'] = $this->obat_model->SemuaData();
        $this->load->view('admin/navbar');
        $this->load->view('admin/admin_message', $data);
        $this->load->view('admin/sidebar');
    }
    public function hapus($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            // Handle invalid ID, maybe show an error message
            redirect('admin');
        }

        $this->obat_model->hapus_data($id);
        redirect('admin');
    }

    public function tambah()
    {
        // Assuming you have a form submitting POST data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array(
                'nama_obat' => $this->input->post('nama_obat'),
                'kemasan' => $this->input->post('kemasan'),
                'harga' => $this->input->post('harga')
                // Add other fields as needed
            );

            // Call the model to add data
            $this->obat_model->tambah_data($data);

            // Redirect or show success message
            redirect('admin/admin');
        } else {
            // Display the form
            $this->load->view('form_tambah');
        }
    }
    public function update()
    {
        // Assuming you are using the CodeIgniter input class
        $id = $this->input->post('id');
        $data = array(
            'nama_obat' => $this->input->post('nama_obat'),
            'kemasan' => $this->input->post('kemasan'),
            'harga' => $this->input->post('harga')
            // Add other fields as needed
        );

        // Call the model function to update the data
        $this->obat_model->update_data($id, $data);

        // Redirect to the admin page or wherever you want to go after the update
        redirect('admin/admin');
    }
}

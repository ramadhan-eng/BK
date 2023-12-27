<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periksa extends CI_Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->load->view('dokter/navbar');
        $this->load->view('dokter/riwayat');
        $this->load->view('dokter/sidebar');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    public function get_pasien_by_name_and_no_ktp($nama, $no_ktp)
    {
        $this->db->where('nama', $nama);
        $this->db->where('no_ktp', $no_ktp);
        $query = $this->db->get('pasien');

        return $query->row_array(); // Return user data if found, otherwise returns null
    }
}

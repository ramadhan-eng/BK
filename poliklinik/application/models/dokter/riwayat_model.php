<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat_model extends CI_Model
{
    public function SemuaData()
    {
        return $this->db->get('pasien')->result_array();
    }
}

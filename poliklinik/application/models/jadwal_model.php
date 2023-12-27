<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    public function SemuaData()
    {
        return $this->db->get('jadwal_periksa')->result_array();
    }
}

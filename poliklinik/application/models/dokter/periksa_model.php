<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periksa_model extends CI_Model
{
    public function SemuaData()
    {
        $this->db->select('daftar_poli.id, daftar_poli.id_pasien,daftar_poli.keluhan,daftar_poli.no_antri,pasien.nama as nama_pasien');
        $this->db->from('daftar_poli');
        $this->db->join('pasien', 'pasien.id = daftar_poli.id_pasien');

        $query = $this->db->get();

        return $query->result();
    }
}

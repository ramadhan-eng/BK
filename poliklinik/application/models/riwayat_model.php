<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat_model extends CI_Model
{
    public function SemuaData()
    {
        $this->db->select('periksa.tgl_periksa, pasien.no_rm, pasien.nama as nama_pasien, periksa.catatan, obat.nama_obat,(periksa.biaya_periksa + obat.harga) as total');
        $this->db->from('periksa');
        $this->db->join('daftar_poli', 'periksa.id_daftar_poli = daftar_poli.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa');
        $this->db->join('obat', 'detail_periksa.id_obat = obat.id');

        $query = $this->db->get();

        return $query->result();
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_model extends CI_Model
{
    public function getDetailPeriksaData($id_pasien)
    {
        $this->db->select('pasien.nama as nama_pasien, dokter.nama as nama_dokter, obat.nama_obat, periksa.tgl_periksa, periksa.catatan, periksa.biaya_periksa, daftar_poli.keluhan');
        $this->db->from('periksa');
        $this->db->join('daftar_poli', 'periksa.id_daftar_poli = daftar_poli.id');
        $this->db->join('jadwal_periksa', 'daftar_poli.id_jadwal = jadwal_periksa.id');
        $this->db->join('dokter', 'jadwal_periksa.id_dokter = dokter.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa', 'left');
        $this->db->join('obat', 'detail_periksa.id_obat = obat.id', 'left');

        // Add a WHERE clause to filter results based on the selected patient's ID
        $this->db->where('daftar_poli.id_pasien', $id_pasien);

        $query = $this->db->get();

        return $query->result_array();
    }
}

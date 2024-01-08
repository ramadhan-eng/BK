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

    public function getPatientName()
    {
        $this->db->select('daftar_poli.id_pasien, pasien.nama as nama_pasien');
        $this->db->from('daftar_poli');
        $this->db->join('pasien', 'pasien.id = daftar_poli.id_pasien');
        // You might want to add a WHERE clause based on the specific $id_pasien

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->nama_pasien;
        } else {
            return 'Nama Pasien Tidak Ditemukan';
        }
    }


    public function insert_periksa($nama_pasien, $tgl_periksa, $catatan, $biaya_periksa)
    {
        // Fetch id_daftar_poli based on nama_pasien using a JOIN query
        $this->db->select('dp.id');
        $this->db->from('daftar_poli dp');
        $this->db->join('pasien p', 'p.id = dp.id_pasien');
        $this->db->where('p.nama', $nama_pasien);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $id_daftar_poli = $result->id;

            // Insert data into 'periksa' table
            $periksa_data = array(
                'id_daftar_poli' => $id_daftar_poli,
                'tgl_periksa' => $tgl_periksa,
                'catatan' => $catatan,
                'biaya_periksa' => $biaya_periksa
            );

            $this->db->insert('periksa', $periksa_data);

            // Return the id of the inserted record
            return $this->db->insert_id();
        } else {
            // Handle the case when no matching record is found
            return false;
        }
    }
    public function insert_detail_periksa($id_periksa, $obat_id)
    {
        $detail_periksa_data = array(
            'id_periksa' => $id_periksa,
            'id_obat' => $obat_id
        );

        $this->db->insert('detail_periksa', $detail_periksa_data);

        // Return true if the insertion was successful
        return $this->db->affected_rows() > 0;
    }
}
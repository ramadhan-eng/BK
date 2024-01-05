<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_pasien_by_no_ktp($no_ktp)
    {
        return $this->db->get_where('pasien', ['no_ktp' => $no_ktp])->row_array();
    }

    public function get_last_queue_number()
    {
        return $this->db->select_max('SUBSTRING(no_rm, 8)', 'last_queue_number', false)
            ->get('pasien')
            ->row_array()['last_queue_number'];
    }

    public function insert_pasien($data)
    {
        $this->db->insert('pasien', $data);
        return $this->db->insert_id();
    }

    // models/Pasien_model.php
    public function get_jadwal_by_poli($poli_id)
    {
        $datajadwal = $this->db->query("SELECT a.nama as nama_dokter, b.hari as hari, b.id as id_jp, b.jam_mulai as jam_mulai, b.jam_selesai as jam_selesai
                                    FROM dokter as a
                                    INNER JOIN jadwal_periksa as b ON a.id = b.id_dokter
                                    WHERE a.id_poli = ?", [$poli_id]);

        return $datajadwal->result_array();
    }

    public function insert_daftar_poli($data)
    {
        $this->db->insert('daftar_poli', $data);
        return $this->db->insert_id();
    }

    public function get_pasien_id_by_no_rm($no_rm)
    {
        $result = $this->db->get_where('pasien', ['no_rm' => $no_rm])->row_array();

        return $result ? $result['id'] : null;
    }

    // models/Pasien_model.php
    public function get_riwayat_daftar_poli($patient_id)
    {
        $this->db->select('d.nama_poli as poli_nama, c.nama as nama_dokter, b.hari as jadwal_hari, b.jam_mulai as jadwal_mulai, b.jam_selesai as jadwal_selesai, a.no_antri as antrian, a.id as poli_id');
        $this->db->from('daftar_poli as a');
        $this->db->join('jadwal_periksa as b', 'a.id_jadwal = b.id');
        $this->db->join('dokter as c', 'b.id_dokter = c.id');
        $this->db->join('poli as d', 'c.id_poli = d.id');
        $this->db->where('a.id_pasien', $patient_id);
        $this->db->order_by('a.id', 'desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_last_queue_number_by_jadwal($id_jadwal)
    {
        return $this->db->select_max('no_antri', 'last_queue_number', false)
            ->where('id_jadwal', $id_jadwal)
            ->get('daftar_poli')
            ->row_array()['last_queue_number'];
    }
}
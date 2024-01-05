<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    public function SemuaData()
    {
        return $this->db->get('jadwal_periksa')->result_array();
    }

    public function tambah_data($data)
    {
        $query = $this->db->query('SELECT MAX(id) AS max_id FROM jadwal_periksa');
        $row = $query->row();
        $max_id = $row->max_id;

        // Increment the id for the new record
        $data['id'] = $max_id + 1;

        // Insert the new record into the obat table
        $this->db->insert('jadwal_periksa', $data);

        // Return the ID of the inserted row
        return $this->db->insert_id();
    }
}
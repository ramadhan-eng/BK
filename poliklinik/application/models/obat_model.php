<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_model extends CI_Model
{
    public function SemuaData()
    {
        return $this->db->get('obat')->result_array();
    }

    public function hapus_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('obat');
    }

    public function tambah_data($data)
    {
        $query = $this->db->query('SELECT MAX(id) AS max_id FROM obat');
        $row = $query->row();
        $max_id = $row->max_id;

        // Increment the id for the new record
        $data['id'] = $max_id + 1;

        // Insert the new record into the obat table
        $this->db->insert('obat', $data);

        // Return the ID of the inserted row
        return $this->db->insert_id();
    }

    public function update_data($id, $data)
    {
        // Update data in the 'obat' table based on the provided ID
        $this->db->where('id', $id);
        $this->db->update('obat', $data);
    }
}

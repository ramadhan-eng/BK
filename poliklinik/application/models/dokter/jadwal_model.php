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
        // Fetch the id_dokter from the session
        $id_dokter = $this->session->userdata('users_id');

        // Debugging statements
        echo "Debug: id_dokter - $id_dokter";
        echo "Debug: Data to be inserted - " . print_r($data, true);

        if ($id_dokter) {
            $data['id_dokter'] = $id_dokter;


            echo "Debug: Insert Query - " . $this->db->last_query();
            // Insert the new record into the jadwal_periksa table
            $this->db->insert('jadwal_periksa', $data);

            // Check for query execution success
            if ($this->db->affected_rows() > 0) {
                echo "Debug: Data inserted successfully!";
            } else {
                echo "Debug: Failed to insert data.";
                echo "Error: " . $this->db->error()['message'];
            }

            // Return the ID of the inserted row
            return $this->db->insert_id();
        } else {
            // Handle the case where the id_dokter is not found
            // You can redirect or show an error message
            echo "Debug: ID Dokter not found!";
        }
    }


    public function getIdDokterByUsername($username)
    {
        $this->db->select('id');
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        } else {
            return false;
        }
    }
}

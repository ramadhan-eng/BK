<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function validate_login($username, $password, $role)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // You may want to hash passwords properly
        $this->db->where('role', $role);
        $query = $this->db->get('users');

        return $query->num_rows() == 1;
    }

    public function getUserId($username)
    {
        $this->db->select('id');
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->id;
        } else {
            return null;
        }
    }
}

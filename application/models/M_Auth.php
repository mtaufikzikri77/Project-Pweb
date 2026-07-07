<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {
    
    public function register($data) {
        return $this->db->insert('users', $data);
    }
    
    public function cek_login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        return $this->db->get('users')->row_array();
    }

    public function cek_username($username) {
        $this->db->where('username', $username);
        return $this->db->get('users')->num_rows();
    }
}
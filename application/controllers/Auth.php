<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Auth');
        $this->load->library('session');
    }

    public function login() {
        $this->load->view('frontend/login');
    }

    public function register() {
        $this->load->view('frontend/register');
    }

    public function proses_register() {

        $name = $this->input->post('name'); 
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        if($password !== $confirm_password) {
            $this->session->set_flashdata('error', 'Password dan Konfirmasi Password tidak cocok!');
            redirect('auth/register');
        }

        if($this->M_Auth->cek_username($email) > 0) {
            $this->session->set_flashdata('error', 'Email sudah terdaftar, gunakan email lain!');
            redirect('auth/register');
        }

        $data = array(
            'username' => $email,
            'password' => md5($password),
            'role_id'  => 2,
            'phone'    => $phone,
            'address'  => $name,
            'status'   => 'active'
        );

        $this->M_Auth->register($data);

        $this->session->set_flashdata('success', 'Akun berhasil dibuat! Silakan Sign In.');
        redirect('auth/login');
    }

    public function proses_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->M_Auth->cek_login($username, $password);
        
        if($user) {
            $this->session->set_userdata('user_id', $user['id']);
            $this->session->set_userdata('username', $user['username']); 
            $this->session->set_userdata('role_id', $user['role_id']); 

            if ($user['role_id'] == 1) {
                redirect('admin/events'); 
            } else {
                redirect('app/home'); 
            }

        } else {
            $this->session->set_flashdata('error', 'Email atau Password salah!');
            redirect('auth/login'); 
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        
        redirect('auth/login');
    }
}
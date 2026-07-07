<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Admin');
        
        if($this->session->userdata('role_id') != 1) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['transactions'] = $this->M_Admin->get_all_transactions();
        $this->load->view('admin/dashboard', $data);
    }

    public function acc_pembayaran($id_transaksi) {
        $this->M_Admin->update_transaction_status($id_transaksi, array('payment_status' => 'Lunas'));
        $this->session->set_flashdata('success', 'Pembayaran berhasil diverifikasi!');
        redirect('admin');
    }

    public function check_in($id_transaksi) {
        $this->M_Admin->update_transaction_status($id_transaksi, array('check_in_status' => 'Digunakan'));
        $this->session->set_flashdata('success', 'Check-in Tiket Berhasil!');
        redirect('admin');
    }

    public function events() {
        $data['events'] = $this->M_Admin->get_all_events();
        $data['categories'] = $this->M_Admin->get_all_categories(); 
        $this->load->view('admin/manage_events', $data);
    }

    public function add_event() {
        $config['upload_path']   = './uploads/events/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048; 
        $config['encrypt_name']  = TRUE; 

        $this->load->library('upload', $config);
        $image = 'default.jpg'; 
        
        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $image = $upload_data['file_name'];
        }

        $data = array(
            'event_code'  => 'EVT-'.time(),
            'title'       => $this->input->post('title'),
            'organizer'   => $this->input->post('organizer'),
            'description' => $this->input->post('description'),
            'location'    => $this->input->post('location'),
            'price'       => $this->input->post('price'),
            'quota'       => $this->input->post('quota'),
            'event_date'  => $this->input->post('event_date'),
            'image'       => $image,
            'status'      => 'Aktif',
            'is_main_event'=> 0 
        );

        $event_id = $this->M_Admin->insert_event($data);
        $category_id = $this->input->post('category_id');
        
        if($category_id) {
            $this->M_Admin->insert_event_category($event_id, $category_id);
        }

        $this->session->set_flashdata('success', 'Event baru berhasil ditambahkan!');
        redirect('admin/events');
    }

    public function set_main_event($event_id) {
        $this->db->update('events', array('is_main_event' => 0));
        $this->db->where('id', $event_id);
        $this->db->update('events', array('is_main_event' => 1));
        $this->session->set_flashdata('success', 'Event berhasil dijadikan Highlight Utama!');
        redirect('admin/events');
    }

    public function cancel_main_event($event_id) {
        $this->db->where('id', $event_id);
        $this->db->update('events', array('is_main_event' => 0));
        $this->session->set_flashdata('success', 'Status Event Utama dibatalkan.');
        redirect('admin/events');
    }

    public function delete_event($id) {
        $event = $this->M_Admin->get_event_by_id($id);
        if ($event && $event->image != 'default.jpg' && file_exists('./uploads/events/'.$event->image)) {
            unlink('./uploads/events/'.$event->image);
        }
        $this->db->where('event_id', $id);
        $this->db->delete('transaction_logs');
        
        $this->M_Admin->delete_event($id);
        $this->session->set_flashdata('success', 'Event dan riwayat transaksi dihapus!');
        redirect('admin/events');
    }
}
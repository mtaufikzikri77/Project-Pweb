<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Event');
    }

    public function index() {
        $data['main_event'] = $this->M_Event->get_main_event(); 
        $data['events']     = $this->M_Event->get_carousel_events(); 
        $this->load->view('frontend/landing', $data);
    }

    public function home() {
        if(!$this->session->userdata('user_id')) redirect('auth/login');
        $data['main_event'] = $this->M_Event->get_main_event();
        $data['events']     = $this->M_Event->get_carousel_events();
        $this->load->view('frontend/landing', $data);
    }

    public function detail($id) {
        if(!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Silakan Login terlebih dahulu.');
            redirect('auth/login');
        }
        $data['event'] = $this->M_Event->get_detail($id);
        $this->load->view('frontend/detail', $data);
    }

    public function checkout() {
        if(!$this->session->userdata('user_id')) redirect('auth/login');
        $data['event_id'] = $this->input->post('event_id');
        $data['qty'] = $this->input->post('qty');
        $data['price'] = $this->input->post('price');
        $data['payment_method'] = $this->input->post('payment_method');
        $data['total_price'] = $data['qty'] * $data['price'];
        $data['event'] = $this->M_Event->get_detail($data['event_id']);
        $this->load->view('frontend/invoice', $data);
    }

    public function proses_bayar() {
        if(!$this->session->userdata('user_id')) redirect('auth/login');
        $event_id = $this->input->post('event_id');
        $qty = $this->input->post('qty');

        $data_trx = array(
            'user_id' => $this->session->userdata('user_id'),
            'event_id' => $event_id,
            'order_date' => date('Y-m-d H:i:s'),
            'ticket_qty' => $qty,
            'total_price' => $this->input->post('total_price'),
            'payment_method' => $this->input->post('payment_method'),
            'payment_status' => 'Pending',
            'check_in_status' => 'Belum'
        );

        $this->M_Event->insert_transaction($data_trx);
        $this->M_Event->decrease_quota($event_id, $qty);
        redirect('app/success');
    }

    public function success() {
        if(!$this->session->userdata('user_id')) redirect('auth/login');
        $this->load->view('frontend/success');
    }

    public function history() {
        if(!$this->session->userdata('user_id')) redirect('auth/login');
        $user_id = $this->session->userdata('user_id');
        $this->db->select('transaction_logs.*, events.title');
        $this->db->from('transaction_logs');
        $this->db->join('events', 'events.id = transaction_logs.event_id', 'left');
        $this->db->where('transaction_logs.user_id', $user_id);
        $this->db->order_by('transaction_logs.id', 'DESC'); 
        $data['histories'] = $this->db->get()->result();
        $this->load->view('frontend/history', $data);
    }

    public function explore() {
        $category = $this->input->get('category');
        $location = $this->input->get('location');
        $sort     = $this->input->get('sort');
        $tersedia = $this->input->get('tersedia'); 

        $data['events']     = $this->M_Event->get_filtered_events($category, $location, $sort, $tersedia);
        $data['categories'] = $this->M_Event->get_categories();
        $data['locations']  = $this->M_Event->get_unique_locations();

        $data['current_cat']  = $category ? $category : 'All';
        $data['current_loc']  = $location ? $location : 'All';
        $data['current_sort'] = $sort ? $sort : 'terbaru';
        $data['tersedia']     = $tersedia; 
        
        $this->load->view('frontend/explore', $data);
    }
}
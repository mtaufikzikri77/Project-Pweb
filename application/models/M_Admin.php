<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {
    
    public function get_all_transactions() {
        $this->db->select('transaction_logs.*, users.username as email, users.address as name, events.title');
        $this->db->from('transaction_logs');
        $this->db->join('users', 'users.id = transaction_logs.user_id', 'left');
        $this->db->join('events', 'events.id = transaction_logs.event_id', 'left');
        $this->db->order_by('transaction_logs.order_date', 'DESC');
        return $this->db->get()->result();
    }

    public function update_transaction_status($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('transaction_logs', $data);
    }

    public function insert_event($data) {
        $this->db->insert('events', $data);
        return $this->db->insert_id(); 
    }

    public function insert_event_category($event_id, $category_id) {
        $data = array('event_id' => $event_id, 'category_id' => $category_id);
        return $this->db->insert('event_category', $data);
    }

    public function get_all_categories() {
        return $this->db->get('categories')->result();
    }

    public function get_all_events() {
        $this->db->select('events.*, categories.name as category_name');
        $this->db->from('events');
        $this->db->join('event_category', 'events.id = event_category.event_id', 'left');
        $this->db->join('categories', 'event_category.category_id = categories.id', 'left');
        $this->db->order_by('events.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_event_by_id($id) {
        return $this->db->get_where('events', array('id' => $id))->row();
    }

    public function delete_event($id) {
        $this->db->where('id', $id);
        return $this->db->delete('events');
    }
}